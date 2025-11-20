<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Actividades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Actividades</h1>
        
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('actividades.create') }}" class="btn btn-primary mb-3">Nueva Actividad</a>
        <a href="{{ route('notas.index') }}" class="btn btn-secondary mb-3">Volver a Notas</a>

        @if ($actividades->isEmpty())
            <p>No hay actividades registradas.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nota</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($actividades as $actividad)
                    <tr>
                        <td>{{ $actividad->id }}</td>
                        <td>{{ $actividad->nota->titulo }}</td>
                        <td>{{ $actividad->descripcion }}</td>
                        <td>
                            <span class="badge bg-{{ $actividad->estado == 'completado' ? 'success' : 'warning' }}">
                                {{ $actividad->estado }}
                            </span>
                        </td>
                        <td>{{ $actividad->fecha_inicio ? $actividad->fecha_inicio->format('d/m/Y') : '-' }}</td>
                        <td>{{ $actividad->fecha_fin ? $actividad->fecha_fin->format('d/m/Y') : '-' }}</td>
                        <td>
                            <a href="{{ route('actividades.show', $actividad->id) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('actividades.edit', $actividad->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('actividades.destroy', $actividad->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar actividad?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>