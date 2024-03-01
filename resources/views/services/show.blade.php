@extends('adminlte::page')

@section('title', 'Estacionamiento | Servicios')

@section('content_header')
    <h1>Servicio adicionales</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
            <a href="{{ route('services.index') }}" class="btn btn-primary mb-3">Regresar</a>
            <ul class="list-group">
              <li class="list-group-item"><strong>Servicio:</strong> {{ $servicio->servicio }}</li>
              <li class="list-group-item"><strong>Costo por hora (en dolares):</strong> {{ $servicio->costo_x_hora }}</li>
              <li class="list-group-item"><strong>Descripcion:</strong> {{ $servicio->descripcion }}</li>
            </ul>
        </div>
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
