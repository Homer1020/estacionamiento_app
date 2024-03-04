<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Transaccion;
use App\Models\Ubicacion;
use App\Models\Vehiculo;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TerminalController extends Controller
{
    public function index() {
        $ubications = Ubicacion::with('transacciones')->get();
        $transactions = Transaccion::with(['vehiculo', 'ubicacion', 'factura'])->orderBy('id', 'DESC')->get();
        return view('terminal.index', [
            'transactions'  => $transactions,
            'ubications'   => $ubications
        ]);
    }

    public function create() {
        return view('terminal.create');
    }

    public function store(Request $request) {
        // buscar vehiculo o crear si no existe
        $vehiculo = Vehiculo::firstOrCreate([
            'matricula' => $request->input('matricula')
        ]);

        // crear transaccion a partir del vehiculo
        $vehiculo->transacciones()->create([
            'ubicacion_id' => $request->input('ubicacion')
        ]);

        return response()->redirectToRoute('terminals.index');
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

    public function precheckout(Transaccion $transaction) {
        return view('facturas.create');
    }

    public function checkoutConfirm(Transaccion $transaction) {
        return view('terminal.checkout', compact('transaction'));
    }

    public function checkout(Request $request, Transaccion $transaction) {

        if(!$request->input('client_id')) {
            $cliente = Cliente::create([
                'nombre'    => $request->input('client_nombre'),
                'apellido'    => $request->input('client_apellido'),
                'cedula'    => $request->input('client_cedula'),
                'telefono'    => $request->input('client_telefono'),
            ]);
        } else {
            $cliente = Cliente::first('id', $request->input('client_id'));
        }

        $cliente->vehiculos()->save($transaction->vehiculo);

        $costo_aparcamiento = $transaction->calcular_costo_aparcamiento();
        
        $invoice = $transaction->factura()->create([
            'codigo'      => uniqid(),
            'monto_total' => $costo_aparcamiento
        ]);
        return response()->redirectToRoute('invoices.show', compact('invoice'));
    }
}
