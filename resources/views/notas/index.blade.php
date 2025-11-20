@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Notas de Usuarios</h1>

    <!-- Formulario para crear nota -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Crear Nueva Nota</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('notas.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="user_id" class="form-label">Usuario</label>
                    <select name="user_id" class="form-control" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" name="titulo" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="contenido" class="form-label">Contenido</label>
                    <textarea name="contenido" class="form-control" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="fecha_vencimiento" class="form-label">Fecha Vencimiento</label>
                    <input type="datetime-local" name="fecha_vencimiento" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Crear Nota</button>
            </form>
        </div>
    </div>

    <!-- Lista de usuarios y sus notas -->
    @foreach($users as $user)
    <div class="card mb-3">
        <div class="card-header">
            <strong>{{ $user->name }}</strong> - Total notas activas: {{ $user->total_notas }}
        </div>
        <div class="card-body">
            @if($user->notas->count() > 0)
                @foreach($user->notas as $nota)
                <div class="border p-3 mb-2">
                    <h6>{{ $nota->titulo_formateado }}</h6>
                    <p class="mb-1">{{ $nota->contenido }}</p>
                    <small class="text-muted">
                        Vence: {{ $nota->recordatorio->fecha_vencimiento->format('d/m/Y H:i') }} | 
                        Estado: {{ $nota->recordatorio->completado ? 'Completado' : 'Pendiente' }}
                    </small>
                    <!-- BOTONES AGREGADOS -->
                    <div class="mt-2">
                        <a href="{{ route('actividades.create') }}?nota_id={{ $nota->id }}" class="btn btn-success btn-sm">Agregar Actividad</a>
                        <form action="{{ route('notas.destroy', $nota->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar nota y todas sus actividades?')">Eliminar Nota</button>
                        </form>
                    </div>
                </div>
                @endforeach
            @else
                <p class="text-muted">No hay notas activas</p>
            @endif
        </div>
    </div>
    @endforeach
</div>
@endsection