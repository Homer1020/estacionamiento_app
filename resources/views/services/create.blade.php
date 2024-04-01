@extends('adminlte::page')

@section('title', 'Estacionamiento | Servicios')

@section('content_header')
    <h1>Sgregar Servicio</h1>
@stop

@section('content')
<div class="card">
  <div class="card-body">
    <a href="{{ route('services.index') }}" class="btn btn-primary mb-3">Regresar</a>
    <form action="{{ route('services.store') }}" method="POST">
      {{ csrf_field() }}
      <x-adminlte-input
        name="servicio"
        type="text"
        placeholder="Lavado a mano"
        label="Servicio"
        autocomplete="off"
        enable-old-support
        required
      />
      <x-adminlte-input
        name="costo"
        type="number"
        placeholder="30$"
        label="Costo por hora"
        autocomplete="off"
        enable-old-support
        required
      />

      <x-adminlte-textarea
        name="descripcion"
        placeholder="Se lava el vehiculo a mano."
        enable-old-support
        label="Descripcion"
        required
      ></x-adminlte-textarea>

      <input type="submit" value="Crear" class="btn btn-primary">
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
