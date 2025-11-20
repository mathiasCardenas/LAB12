<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Actividad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Detalles de Actividad</h1>
        <div class="card">
            <div class="card-body">
                <p><strong>ID:</strong> {{ $actividad->id }}</p>
                <p><strong>Nota:</strong> {{ $actividad->nota->titulo }}</p>
                <p><strong>Descripción:</strong> {{ $actividad->descripcion }}</p>
                <p><strong>Estado:</strong> 
                    <span class="badge bg-{{ $actividad->estado == 'completado' ? 'success' : 'warning' }}">
                        {{ $actividad->estado }}
                    </span>
                </p>
                <p><strong>Fecha Inicio:</strong> {{ $actividad->fecha_inicio ? $actividad->fecha_inicio->format('d/m/Y') : 'No definida' }}</p>
                <p><strong>Fecha Fin:</strong> {{ $actividad->fecha_fin ? $actividad->fecha_fin->format('d/m/Y') : 'No definida' }}</p>
                <p><strong>Creado:</strong> {{ $actividad->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Actualizado:</strong> {{ $actividad->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
        
        <div class="mt-3">
            <a href="{{ route('actividades.index') }}" class="btn btn-secondary">Volver</a>
            <a href="{{ route('actividades.edit', $actividad->id) }}" class="btn btn-warning">Editar</a>
        </div>
    </div>
</body>
</html>