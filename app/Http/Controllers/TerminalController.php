<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Transaccion;
use App\Models\Ubicacion;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TerminalController extends Controller
{
    public function index() {
        $ubications = Ubicacion::all();
        $transactions = Transaccion::orderBy('id', 'DESC')->get();
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
}
