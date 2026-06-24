<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use Illuminate\Http\Request;

class RegistroController extends Controller
{
    public function index()
    {
        $registros = Registro::orderBy('fecha_hora', 'desc')->paginate(10);
        return view('registros.index', compact('registros'));
    }

    public function create()
    {
        return view('registros.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'temperatura' => 'required|numeric|min:0|max:100',
            'tiempo_operacion' => 'required|integer|min:1',
            'fase' => 'required|in:enfriamiento,fermentacion,reposo',
            'fecha_hora' => 'required|date',
            'observaciones' => 'nullable|string|max:500',
        ], [
            'temperatura.required' => 'La temperatura es obligatoria.',
            'temperatura.numeric' => 'La temperatura debe ser un número.',
            'tiempo_operacion.required' => 'El tiempo de operación es obligatorio.',
            'fase.required' => 'Debe seleccionar una fase.',
        ]);

        // Convertir checkboxes a booleanos
        $validated['estado_ventilador'] = $request->has('estado_ventilador');
        $validated['estado_agitador'] = $request->has('estado_agitador');

        Registro::create($validated);

        return redirect()->route('registros.index')
                         ->with('success', 'Registro creado exitosamente.');
    }

    public function show(Registro $registro)
    {
        return view('registros.show', compact('registro'));
    }

    public function edit(Registro $registro)
    {
        return view('registros.edit', compact('registro'));
    }

    public function update(Request $request, Registro $registro)
    {
        $validated = $request->validate([
            'temperatura' => 'required|numeric|min:0|max:100',
            'tiempo_operacion' => 'required|integer|min:1',
            'fase' => 'required|in:enfriamiento,fermentacion,reposo',
            'fecha_hora' => 'required|date',
            'observaciones' => 'nullable|string|max:500',
        ]);

        // Convertir checkboxes a booleanos (el hidden envía 0, el checkbox envía 1 si está marcado)
        $validated['estado_ventilador'] = $request->has('estado_ventilador');
        $validated['estado_agitador'] = $request->has('estado_agitador');

        $registro->update($validated);

        return redirect()->route('registros.index')
                         ->with('success', 'Registro actualizado correctamente.');
    }

    public function destroy(Registro $registro)
    {
        $registro->delete();
        return redirect()->route('registros.index')
                         ->with('success', 'Registro eliminado.');
    }
}
