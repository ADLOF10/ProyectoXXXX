<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aprobaciones de Usuarios</title>
    <link rel="stylesheet" href="{{ asset('css/stylesgeneracion.css') }}">
</head>
<body>
    <header>
        <h1>Aprobaciones de Registro</h1>
    </header>

    <main>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo Personal</th>
                    <th>Tipo de Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($solicitudes as $solicitud)
                    <tr>
                        <td>{{ $solicitud->nombre }}</td>
                        <td>{{ $solicitud->correo_personal }}</td>
                        <td>{{ ucfirst($solicitud->tipo_usuario) }}</td>
                        <td>
                            <form action="{{ route('aprobarRegistro', $solicitud->id) }}" method="POST">
                                @csrf
                                <button type="submit">Aprobar</button>
                            </form>
                            <form action="{{ route('rechazarRegistro', $solicitud->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Rechazar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</body>
</html>
