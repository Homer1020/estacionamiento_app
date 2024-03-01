@extends('adminlte::page')

@section('title', 'Estacionamiento | Terminal')

@section('content_header')
    <h1>Terminal</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
            <form action="{{ route('terminals.create') }}" method="POST">
                @csrf
                <div class="row align-items-end">
                    <div class="col-md-3">
                        <x-adminlte-input
                            name="matricula"
                            type="text"
                            placeholder="xxx xxx xxx"
                            label="Matricula"
                            autocomplete="off"
                        />
                    </div>
                    <div class="col-md-3">
                        <x-adminlte-select
                            name="ubicacion"
                            type="text"
                            placeholder="xxx xxx xxx"
                            label="Ubicación"
                        >
                            <option selected disabled>Seleccionar ubicación</option>
                            @foreach ($ubications as $ubication)
                                <option value="{{ $ubication->id }}">{{ $ubication->ubicacion }} ({{ $ubication->costo_x_hora }}$ la hora)</option>
                            @endforeach
                        </x-adminlte-select>
                        
                    </div>
                    <div class="col-md-3">
                        <x-adminlte-button
                            class="mb-3"
                            label="Registrar"
                            theme="primary"
                            type="submit"
                        />
                    </div>
                </div>
            </form>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Vehiculo</th>
                        <th>Puesto</th>
                        <th>Fecha entrada</th>
                        <th>Fecha salida</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->vehiculo->matricula }}</td>
                            <td>{{ $transaction->ubicacion->ubicacion }}</td>
                            <td>{{ $transaction->fecha_entrada }}</td>
                            <td>
                                @if ($transaction->fecha_salida)
                                    {{ $transaction->fecha_salida }}
                                @else
                                    {{-- <form class="d-inline-block" action="{{ route('terminals.update', $transaction->id) }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <input type="submit" value="Marcar salida" class="btn btn-primary">
                                    </form> --}}
                                    {{ str_repeat('-', 10) }}
                                @endif
                            </td>
                            <td>
                                <a href="" class="btn btn-info">
                                    <i class="fa fa-plus"></i>
                                    Servicios
                                </a>
                                
                                @if ($transaction->factura)
                                    <a class="btn btn-success" href="{{ route('invoices.show', $transaction->factura) }}">
                                        <i class="fa fa-file-invoice"></i>
                                        Ver factura
                                    </a>
                                @else
                                    <form class="d-inline" action="{{ route('terminals.checkout', $transaction) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-file-invoice"></i>
                                            Facturar
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('terminals.destroy', $transaction) }}" class="d-inline" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-secondary">
                                        <i class="fa fa-trash"></i>
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <p>No hay transacciones aun</p>
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
