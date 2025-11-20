<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Nota;
use Illuminate\Http\Request;

class ActividadController extends Controller
{
    public function index()
    {
        $actividades = Actividad::with('nota')->get();
        return view('actividades.index', compact('actividades'));
    }

    public function create()
    {
        $notas = Nota::all();
        return view('actividades.create', compact('notas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nota_id' => 'required|exists:notas,id',
            'descripcion' => 'required|string',
            'estado' => 'required|string',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after:fecha_inicio',
        ]);

        Actividad::create($request->all());
        return redirect()->route('actividades.index')->with('success', 'Actividad creada correctamente.');
    }

    public function show(Actividad $actividad)
    {
        return view('actividades.show', compact('actividad'));
    }

    public function edit(Actividad $actividad)
    {
        $notas = Nota::all();
        return view('actividades.edit', compact('actividad', 'notas'));
    }

    public function update(Request $request, Actividad $actividad)
    {
        $request->validate([
            'nota_id' => 'required|exists:notas,id',
            'descripcion' => 'required|string',
            'estado' => 'required|string',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after:fecha_inicio',
        ]);

        $actividad->update($request->all());
        return redirect()->route('actividades.index')->with('success', 'Actividad actualizada correctamente.');
    }

    public function destroy(Actividad $actividad)
    {
        $actividad->delete();
        return redirect()->route('actividades.index')->with('success', 'Actividad eliminada correctamente.');
    }
}