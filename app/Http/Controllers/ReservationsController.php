<?php

namespace App\Http\Controllers;

use App\Models\Transaccion;
use App\Models\Ubicacion;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ubications = Ubicacion::with('transacciones')->get();
        $transactions = Transaccion::where('es_reserva', true)->with(['vehiculo', 'ubicacion', 'factura'])->orderBy('id', 'DESC')->get();
        return view('reservations.index', [
            'transactions'  => $transactions,
            'ubications'   => $ubications
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();
        $payload = $request->validate([
            'matricula' => 'required|string|regex:/^([A-Z]{1,2})?\d{4}([A-Z]{2,3})$/',
            'fecha_entrada' => 'required|date|after:now'
        ],
        [
            'matricula.regex' => 'Debe ser similar a AB1234CD, 1234EF, XYZ456',
            'fecha_entrada' => 'Debe ser un día después'
        ]);

        // buscar vehiculo o crear si no existe y estacionarlo
        $vehiculo = Vehiculo::firstOrCreate([
            'matricula'     => $payload['matricula'],
        ]);

        // si el vehiculo esta estacionado o reservado
        if($vehiculo->en_transaccion) {
            return response()->redirectToRoute('reservaciones.index')->with('info', 'Este vehiculo ya está formando parte de una transaccion.');
        }

        // crear transaccion a partir del vehiculo
        $vehiculo->transacciones()->create([
            'ubicacion_id'  => $request->input('ubicacion'),
            'es_reserva'    => true,
            'fecha_entrada' => $request->input('fecha_entrada')
        ]);

        $vehiculo->en_transaccion = true;
        $vehiculo->save();
        return response()->redirectToRoute('reservaciones.index')->with('info', 'Se agrego correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
