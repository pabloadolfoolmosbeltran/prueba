@extends('layouts.app')

@section('title', 'Editar Registro')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Editar Registro #{{ $registro->id }}</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Modifique los datos</h6>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Error:</strong> Corrija los siguientes campos:
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('registros.update', $registro) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="temperatura">Temperatura (°C) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" class="form-control @error('temperatura') is-invalid @enderror"
                           id="temperatura" name="temperatura" value="{{ old('temperatura', $registro->temperatura) }}" required>
                    @error('temperatura')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="custom-control custom-switch">
                            <input type="hidden" name="estado_ventilador" value="0">
                            <input type="checkbox" class="custom-control-input" id="estado_ventilador" name="estado_ventilador" value="1"
                                   {{ old('estado_ventilador', $registro->estado_ventilador) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="estado_ventilador">Ventilador Encendido</label>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="custom-control custom-switch">
                            <input type="hidden" name="estado_agitador" value="0">
                            <input type="checkbox" class="custom-control-input" id="estado_agitador" name="estado_agitador" value="1"
                                   {{ old('estado_agitador', $registro->estado_agitador) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="estado_agitador">Agitador Encendido</label>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="tiempo_operacion">Tiempo de Operación (minutos) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('tiempo_operacion') is-invalid @enderror"
                               id="tiempo_operacion" name="tiempo_operacion" value="{{ old('tiempo_operacion', $registro->tiempo_operacion) }}" min="1" required>
                        @error('tiempo_operacion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fase">Fase del Proceso <span class="text-danger">*</span></label>
                        <select class="form-control @error('fase') is-invalid @enderror" id="fase" name="fase" required>
                            <option value="">Seleccione...</option>
                            <option value="enfriamiento" {{ old('fase', $registro->fase) == 'enfriamiento' ? 'selected' : '' }}>Enfriamiento</option>
                            <option value="fermentacion" {{ old('fase', $registro->fase) == 'fermentacion' ? 'selected' : '' }}>Fermentación</option>
                            <option value="reposo" {{ old('fase', $registro->fase) == 'reposo' ? 'selected' : '' }}>Reposo</option>
                        </select>
                        @error('fase')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="fecha_hora">Fecha y Hora <span class="text-danger">*</span></label>
                    <input type="datetime-local" class="form-control @error('fecha_hora') is-invalid @enderror"
                           id="fecha_hora" name="fecha_hora"
                           value="{{ old('fecha_hora', $registro->fecha_hora->format('Y-m-d\TH:i')) }}" required>
                    @error('fecha_hora')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <textarea class="form-control @error('observaciones') is-invalid @enderror"
                              id="observaciones" name="observaciones" rows="3">{{ old('observaciones', $registro->observaciones) }}</textarea>
                    @error('observaciones')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('registros.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection