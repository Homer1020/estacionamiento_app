<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
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
            'matricula' => 'string'
        ]);

        // buscar vehiculo o crear si no existe y estacionarlo
        $vehiculo = Vehiculo::firstOrCreate([
            'matricula' => $payload['matricula']
        ]);

        if($vehiculo->estacionado || $vehiculo->reservado) {
            return response()->redirectToRoute('terminals.index')->with('info', 'Este vehiculo ya está reservado o estacionado.');
        }

        // crear transaccion a partir del vehiculo
        $vehiculo->transacciones()->create([
            'ubicacion_id' => $request->input('ubicacion')
        ]);

        $vehiculo->estacionado = true;
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
        $transaction->delete();
        return response()->redirectToRoute('terminals.index');
    }

    // public function precheckout(Transaccion $transaction) {
    //     return view('facturas.create');
    // }

    public function checkoutConfirm(Transaccion $transaction) {
        return view('terminal.checkout', compact('transaction'));
    }

    public function checkout(Request $request, Transaccion $transaction) {

        // manage client
        if(!$request->input('client_id')) {
            // validate form data
            $payload = $request->validate([
                'client_nombre'    => 'string',
                'client_apellido'  => 'string',
                'client_cedula'    => 'string',
                'client_telefono'  => 'string',
            ]);

            // store client
            $cliente = Cliente::create([
                'nombre'    => $payload['client_nombre'],
                'apellido'    => $payload['client_apellido'],
                'cedula'    => $payload['client_cedula'],
                'telefono'    => $payload['client_telefono'],
            ]);
        } else {
            $cliente = Cliente::first('id', $request->input('client_id'));
        }

        // el vehiculo ya no esta estacionado
        $transaction->vehiculo->estacionado = false;

        $cliente->vehiculos()->save($transaction->vehiculo);

        $costo_aparcamiento = $transaction->calcular_costo_aparcamiento();
        
        $invoice = $transaction->factura()->create([
            'codigo'      => uniqid(),
            'monto_total' => $costo_aparcamiento
        ]);
        return response()->redirectToRoute('invoices.show', compact('invoice'));
    }
}
