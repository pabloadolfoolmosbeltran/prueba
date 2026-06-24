@extends('layouts.app')

@section('title', 'Detalle del Registro')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detalle del Registro #{{ $registro->id }}</h1>
        <div>
            <a href="{{ route('registros.edit', $registro) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i> Editar
            </a>
            <a href="{{ route('registros.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table table-bordered">
                <tr><th>ID</th><td>{{ $registro->id }}</td></tr>
                <tr><th>Temperatura</th><td>{{ $registro->temperatura }} °C</td></tr>
                <tr><th>Ventilador</th><td>{{ $registro->estado_ventilador ? 'Encendido' : 'Apagado' }}</td></tr>
                <tr><th>Agitador</th><td>{{ $registro->estado_agitador ? 'Encendido' : 'Apagado' }}</td></tr>
                <tr><th>Tiempo de Operación</th><td>{{ $registro->tiempo_operacion }} minutos</td></tr>
                <tr><th>Fase</th><td>{{ ucfirst($registro->fase) }}</td></tr>
                <tr><th>Fecha y Hora</th><td>{{ $registro->fecha_hora->format('d/m/Y H:i:s') }}</td></tr>
                <tr><th>Observaciones</th><td>{{ $registro->observaciones ?: 'Ninguna' }}</td></tr>
                <tr><th>Creado</th><td>{{ $registro->created_at->format('d/m/Y H:i') }}</td></tr>
                <tr><th>Actualizado</th><td>{{ $registro->updated_at->format('d/m/Y H:i') }}</td></tr>
            </table>
        </div>
    </div>
@endsection