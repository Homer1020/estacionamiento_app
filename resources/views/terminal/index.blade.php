@extends('adminlte::page')

@section('plugins.DatatablesPlugin', true)

@section('title', 'Estacionamiento | Terminal')

@section('content_header')
    <h1>Terminal</h1>
@stop

@section('content')

@php
    $heads = [
        'Vehiculo',
        'Puesto',
        'Fecha entrada',
        'Fecha salida',
        'Acciones'
    ];

    $config = [
        'order'     => [2, 'desc'],
        'columns'   => [null, null, null, null, ['orderable' => false]],
        'language'  => [
            'url'   => '//cdn.datatables.net/plug-ins/2.0.1/i18n/es-ES.json' // this is the solution
        ]
    ]
@endphp

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
            <x-adminlte-datatable
                id="terminal-table"
                :heads="$heads"
                :config="$config"
                striped
            >
                @forelse ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->vehiculo->matricula }}</td>
                        <td>{{ $transaction->ubicacion->ubicacion }}</td>
                        <td>{{ $transaction->fecha_entrada }}</td>
                        <td>
                            @if ($transaction->fecha_salida)
                                {{ $transaction->fecha_salida }}
                            @else
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
                                <a href="{{ route('terminals.checkoutConfirm', $transaction) }}" class="btn btn-success">
                                    <i class="fa fa-file-invoice"></i>
                                    Facturar
                                </a>
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
                @endforeach
            </x-adminlte-datatable>
        </div>
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        // $('#terminal-table').DataTable({
        //     language: {
        //        url: '//cdn.datatables.net/plug-ins/2.0.1/i18n/es-ES.json',
        //     }
        // })
    </script>
@endsection