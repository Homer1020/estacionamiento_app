@extends('adminlte::page')

@section('title', 'Estacionamiento | Terminal')

@section('css')
  <style>
    @media print {
      .btn {
        display: none;
      }
    }
  </style>
@stop

@section('content_header')
  <h1>Factura {{ $invoice->codigo }}</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
      <a href="{{ route('terminals.index') }}" class="btn btn-primary mb-3">Regresar</a>
      <h2 class="h5 mb-3 text-uppercase">Detalles</h2>
      <ul class="list-group mb-3">
        <li class="list-group-item"><strong>Código:</strong> {{ $invoice->codigo }}</li>
        <li class="list-group-item"><strong>Fecha:</strong> {{ $invoice->created_at }}</li>
        <li class="list-group-item"><strong>Vehículo:</strong> {{ $invoice->transaccion->vehiculo->matricula }}</li>
      </ul>

      <h2 class="h5 mb-3 text-uppercase">Servicios</h2>
      <ul class="list-group mb-3">
        <li class="list-group-item">
          <h3 class="h6 text-uppercase font-weight-bold">Aparcamiento</h3>
          <strong>Costo: </strong> {{ $invoice->transaccion->calcular_costo_aparcamiento() }}$
          <br>
          <strong>Entrada: </strong> {{ $invoice->transaccion->fecha_entrada }}
          <br>
          <strong>Salida: </strong> {{ $invoice->transaccion->fecha_salida }}
          <br>
          <strong>Ubicación: </strong> {{ $invoice->transaccion->ubicacion->ubicacion }}
        </li>
        @foreach ($invoice->transaccion->servicios as $service)
          <li class="list-group-item">
            <h3 class="h6 text-uppercase font-weight-bold">{{ $service->servicio }}</h3>
            <strong>Precio: </strong> {{ $service->costo_x_hora }}$
          </li>
        @endforeach
      </ul>

      <p><strong>Monto total: </strong> {{ $invoice->monto_total }}$</p>

      <a href="#" id="print" class="btn btn-primary">
        <i class="fa fa-file-pdf"></i>
        Imprimir
      </a>
    </div>
</div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
  <script>
    const $print = document.getElementById('print')

    $print.addEventListener('click', e => {
      e.preventDefault()

      print()
    })
  </script>
@stop
