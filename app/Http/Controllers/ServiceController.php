<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('services.create', [ 'servicio' => new Service() ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // a comment
        $request->validate([
            'servicio'      => 'string',
            'costo_x_hora'  => 'integer',
        ]);
        Service::create([
            'servicio'  => $request->input('servicio'),
            'costo_x_hora'  => $request->input('costo_x_hora'),
            'descripcion'  => $request->input('descripcion'),
        ]);
    
        return response()->redirectToRoute('services.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $servicio)
    {
        return view('services.show', compact('servicio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $servicio)
    {
        return view('services.edit', compact('servicio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $servicio)
    {
        $servicio->servicio = $request->input('servicio');
        $servicio->costo_x_hora = $request->input('costo_x_hora');
        $servicio->descripcion = $request->input('descripcion');
        
        $servicio->save();
    
        return response()->redirectToRoute('services.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $servicio)
    {
        $servicio->delete();
        return response()->redirectToRoute('services.index');
    }
}
