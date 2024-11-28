<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aprobaciones</title>
    <link rel="stylesheet" href="{{ asset('css/stylesaprobaciones.css') }}">
</head>
<body>
    <header class="header">
        <h1>Gestión de Aprobaciones</h1>
    </header>

    <main class="main-container">
        <h2>Usuarios Pendientes de Aprobación</h2>
        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif
        <table class="approval-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Fecha de Registro</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->nombre }} {{ $user->apellidos }}</td>
                        <td>{{ $user->correo_personal }}</td>
                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        <td>
                            <form action="{{ route('aprobar', $user->id) }}" method="POST">
                                @csrf
                                <select name="role" required>
                                    <option value="alumno">Alumno</option>
                                    <option value="academico">Académico</option>
                                </select>
                        </td>
                        <td>
                            <button type="submit" class="approve-button">Aprobar</button>
                            </form>
                            <form action="{{ route('rechazar', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="reject-button">Rechazar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>

    <footer class="footer">
        <p>&copy; 2024 Universidad - Todos los derechos reservados</p>
    </footer>
</body>
</html>
