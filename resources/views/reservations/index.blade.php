@extends('adminlte::page')

@section('plugins.DatatablesPlugin', true)

@section('title', 'Estacionamiento | Terminal')

@section('content_header')
    <h1>Reservaciones</h1>
@stop

@section('content')
@if (session()->has('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
@endif
@php
    $heads = [
        'ID',
        'Vehiculo',
        'Puesto',
        'Fecha entrada',
        'Fecha salida',
        'Acciones'
    ];

    $config = [
        'order'     => [3, 'desc'],
        'columns'   => [null, null, null, null, null, ['orderable' => false]],
        'language'  => [
            'url'   => '//cdn.datatables.net/plug-ins/2.0.1/i18n/es-ES.json' // this is the solution
        ]
    ];
@endphp

<div class="card">
    <div class="card-body">
            <form action="{{ route('reservaciones.store') }}" method="POST">
                @csrf
                <div class="row align-items-baseline">
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
                            @foreach ($ubications as $ubication)
                                @php
                                    $notAvailable = $ubication->transacciones()->where('fecha_salida', null)->exists()
                                @endphp
                                <option value="{{ $ubication->id }}" {{ $notAvailable ? 'disabled' : '' }}>{{ $ubication->ubicacion }} ({{ $ubication->costo_x_hora }}$ la hora)
                                    {{ $notAvailable ? 'En uso' : 'Disponible' }}
                                </option>
                            @endforeach
                        </x-adminlte-select>
                        
                    </div>
                    <div class="col-md-3">
                        <x-adminlte-input
                            name="fecha_entrada"
                            type="datetime-local"
                            label="Fecha y hora"
                        />
                    </div>
                    <div class="col-md-3" style="align-self: flex-end">
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
                        <td>#{{ $transaction->id }}</td>
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
                            @if ($transaction->factura)
                                <a class="btn btn-success" href="{{ route('invoices.show', $transaction->factura) }}">
                                    <i class="fa fa-file-invoice"></i>
                                    Ver factura
                                </a>
                            @else
                                <a href="{{ route('reservaciones.checkoutConfirm', $transaction) }}" class="btn btn-success">
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
@stop

@section('js')
    <script>
    </script>
@endsection