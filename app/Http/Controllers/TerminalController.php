<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Service;
use App\Models\Transaccion;
use App\Models\Ubicacion;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TerminalController extends Controller
{
    public function index() {
        $ubications = Ubicacion::with('transacciones')->get();
        $transactions = Transaccion::where('es_reserva', false)->with(['vehiculo', 'ubicacion', 'factura'])->orderBy('id', 'DESC')->get();
        return view('terminal.index', [
            'transactions'  => $transactions,
            'ubications'   => $ubications
        ]);
    }

    public function create() {
        // return view('terminal.create');
    }

    public function store(Request $request) {
        $payload = $request->validate([
            'matricula' => 'required|string'
        ]);

        // buscar vehiculo o crear si no existe y estacionarlo
        $vehiculo = Vehiculo::firstOrCreate([
            'matricula' => $payload['matricula']
        ]);

        if($vehiculo->en_transaccion) {
            return response()->redirectToRoute('terminals.index')->with('info', 'Este vehiculo ya está en una transaccion.');
        }

        // crear transaccion a partir del vehiculo
        $transaction = $vehiculo->transacciones()->create([
            'ubicacion_id' => $request->input('ubicacion')
        ]);

        $transaction->ubicacion->update(['ocupado' => true]);
        $vehiculo->en_transaccion = true;
        $vehiculo->save();

        return response()->redirectToRoute('terminals.index')->with('info', 'Se agrego correctamente.');
    }

    public function update(int $id) {
        $transaction = Transaccion::findOrFail($id);
        $transaction->fecha_salida = DB::raw('CURRENT_TIMESTAMP');
        $transaction->save();
        return response()->redirectToRoute('terminals.index');
    }

    public function destroy(Transaccion $transaction) {
        $transaction->ubicacion->update(['ocupado' => false]);
        $transaction->vehiculo->update(['en_transaccion' => false]);
        $transaction->delete();
        return back();
    }

    // public function precheckout(Transaccion $transaction) {
    //     return view('facturas.create');
    // }

    public function checkoutConfirm(Transaccion $transaction) {
        $services = Service::all();
        return view('terminal.checkout', compact('transaction', 'services'));
    }

    public function checkout(Request $request, Transaccion $transaction) {
        // manage client
        if(!$request->input('client_id')) {
            // validate form data
            $payload = $request->validate([
                'client_cedula'    => 'required|string',
                'client_nombre'    => 'nullable|string',
                'client_apellido'  => 'nullable|string',
                'client_telefono'  => 'nullable|string',
            ]);

            $cliente = Cliente::firstOrCreate([
                'cedula'    => $payload['client_cedula'],
            ], [
                'nombre'    => $payload['client_nombre'],
                'apellido'  => $payload['client_apellido'],
                'telefono'  => $payload['client_telefono'],
            ]);
        } else {
            $cliente = Cliente::first('id', $request->input('client_id'));
        }

        // el vehiculo ya no esta estacionado
        $transaction->vehiculo->en_transaccion = false;
        $transaction->ubicacion->update(['ocupado' => false]);
        $transaction->servicios()->attach($request->input('servicios'));

        $cliente->vehiculos()->save($transaction->vehiculo);

        $costo_aparcamiento = $transaction->calcular_costo_aparcamiento();
        
        foreach($transaction->servicios as $service) {
            $costo_aparcamiento += $service->costo_x_hora;
        }
        
        $invoice = $transaction->factura()->create([
            'codigo'      => uniqid(),
            'monto_total' => $costo_aparcamiento
        ]);

        return response()->redirectToRoute('invoices.show', compact('invoice'));
    }
}
