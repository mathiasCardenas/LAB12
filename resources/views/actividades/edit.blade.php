<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Actividad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Editar Actividad</h1>
        <form action="{{ route('actividades.update', $actividad->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="nota_id" class="form-label">Nota</label>
                <select name="nota_id" class="form-control @error('nota_id') is-invalid @enderror" required>
                    @foreach($notas as $nota)
                        <option value="{{ $nota->id }}" {{ $actividad->nota_id == $nota->id ? 'selected' : '' }}>
                            {{ $nota->titulo }}
                        </option>
                    @endforeach
                </select>
                @error('nota_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" rows="3" required>{{ old('descripcion', $actividad->descripcion) }}</textarea>
                @error('descripcion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select name="estado" class="form-control @error('estado') is-invalid @enderror" required>
                    <option value="pendiente" {{ $actividad->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="en_progreso" {{ $actividad->estado == 'en_progreso' ? 'selected' : '' }}>En Progreso</option>
                    <option value="completado" {{ $actividad->estado == 'completado' ? 'selected' : '' }}>Completado</option>
                </select>
                @error('estado')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                <input type="date" class="form-control @error('fecha_inicio') is-invalid @enderror" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio', $actividad->fecha_inicio ? $actividad->fecha_inicio->format('Y-m-d') : '') }}">
                @error('fecha_inicio')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="fecha_fin" class="form-label">Fecha Fin</label>
                <input type="date" class="form-control @error('fecha_fin') is-invalid @enderror" id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin', $actividad->fecha_fin ? $actividad->fecha_fin->format('Y-m-d') : '') }}">
                @error('fecha_fin')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('actividades.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>