@extends('adminlte::page')

@section('title', 'Estacionamiento | Servicios')

@section('content_header')
    <h1>Servicio adicionales</h1>
@stop

@section('content')
{{-- <x-adminlte-modal id="newService" title="Nuevo servicio" size='lg'>
  <form action="{{ route('services.store') }}" method="POST">
    @include('services.form')
  </form>
  <x-slot name="footerSlot">
    <x-adminlte-button theme="primary" label="Agregar"/>
    <x-adminlte-button theme="secondary" label="Cancelar" data-dismiss="modal"/>
  </x-slot>
</x-adminlte-modal> --}}

<div class="card">
    <div class="card-body">
            <a href="{{ route('services.create') }}" class="btn btn-primary mb-3">Nuevo servicio</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Servicio</th>
                        <th>Costo base (en dolares)</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($services as $service)
                        <tr>
                            <td>
                              {{ $service->servicio }}
                            </td>
                            <td>
                              {{ $service->costo_x_hora }}$
                            </td>
                            <td>
                                <a href="{{ route('services.show', $service) }}" class="btn btn-primary">
                                    <i class="fa fa-eye "></i>
                                    Detalles
                                </a>
                            
                                <a href="{{ route('services.edit', $service) }}" class="btn btn-warning">
                                    <i class="fa fa-pen"></i>
                                    Editar
                                </a>
                                
                                <form action="{{ route('services.destroy', $service) }}" class="d-inline" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <p>No hay servicios aun</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
