@extends('adminlte::page')

@section('title', 'Estacionamiento | Servicios')

@section('content_header')
    <h1>Editar Servicio "{{ $servicio->servicio }}"</h1>
@stop

@section('content')
<div class="card">
  <div class="card-body">
    <a href="{{ route('services.index') }}" class="btn btn-primary mb-3">Regresar</a>
    <form action="{{ route('services.update', $servicio) }}" method="POST">
      {{ csrf_field() }}
      @method('PUT')
      <x-adminlte-input
        name="servicio"
        type="text"
        placeholder="Lavado a mano"
        label="Servicio"
        autocomplete="off"
        enable-old-support
        value="{{ $servicio->servicio }}"
      />
      <x-adminlte-input
        name="costo"
        type="number"
        placeholder="30$"
        label="Costo por hora"
        autocomplete="off"
        enable-old-support
        value="{{ $servicio->costo_x_hora }}"
      />

      <x-adminlte-textarea
        name="descripcion"
        placeholder="Se lava el vehiculo a mano."
        enable-old-support
        label="Descripcion"
      >{{ $servicio->descripcion }}</x-adminlte-textarea>

      <input type="submit" value="Guardar" class="btn btn-primary">
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
