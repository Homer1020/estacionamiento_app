@extends('adminlte::page')

@section('title', 'Estacionamiento | Servicios')

@section('content_header')
    <h1>Servicio adicionales</h1>
@stop

@section('content')
<div class="card">
  <div class="card-body">
    <a href="{{ route('services.index') }}" class="btn btn-primary mb-3">Regresar</a>
    <form action="{{ route('services.store') }}" method="POST">
      @include('services.form')
      <x-adminlte-button
        label="Crear servicio"
        theme="primary"
        type="submit"
      />
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
