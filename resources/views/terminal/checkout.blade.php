@extends('adminlte::page')

@section('title', 'Estacionamiento | Facturar')

@section('content_header')
    <h1>Facturar</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
      <a href="{{ route('terminals.index') }}" class="btn btn-primary mb-3">Regresar</a>
      <form action="{{ route('terminals.checkout', $transaction) }}" method="POST">
        <h2 class="h5 mb-3 text-uppercase">Datos del cliente</h2>
        @if (!$transaction->vehiculo->cliente_id)
          <div class="row">
            <div class="col-md-6">
              <x-adminlte-input
                name="client_nombre"
                label="Nombre"
              />
            </div>
            <div class="col-md-6">
              <x-adminlte-input
                name="client_apellido"
                label="Apellido"
              />
            </div>
            <div class="col-md-6">
              <x-adminlte-input
                name="client_cedula"
                label="Cedula"
              />
            </div>
            <div class="col-md-6">
              <x-adminlte-input
                name="client_telefono"
                label="Telefono"
              />
            </div>
          </div>
        @else
          <ul class="list-group mb-3">
            <li class="list-group-item">
              <strong>Nombre: </strong> {{ $transaction->vehiculo->propietario->nombre }}
            </li>
            <li class="list-group-item">
              <strong>Apellido: </strong> {{ $transaction->vehiculo->propietario->apellido }}
            </li>
            <li class="list-group-item">
              <strong>Cedula: </strong> {{ $transaction->vehiculo->propietario->cedula }}
            </li>
            <li class="list-group-item">
              <strong>Telefono: </strong> {{ $transaction->vehiculo->propietario->telefono }}
            </li>
          </ul>
        @endif

        <h2 class="h5 mb-3 text-uppercase">Servicios</h2>
        @csrf
        <button type="submit" class="btn btn-success">
          <i class="fa fa-file-invoice"></i>
          Facturar
        </button>
      </form>
    </div>
</div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop