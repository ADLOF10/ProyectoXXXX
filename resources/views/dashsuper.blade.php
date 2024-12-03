<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Aprobaciones</title>
    <link rel="stylesheet" href="{{ asset('css/stylesdashsuper.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Panel de Administración</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashsuper') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="text-center" style="color: #004d40;">Gestión de Aprobaciones</h1>

        <!-- Solicitudes de Alumnos -->
        <h2 class="mt-5" style="color: #004d40;">Solicitudes de Alumnos</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Correo Institucional</th>
                    <th>Numero de Cuenta</th>
                    <th>Grupo</th>
                    <th>Semestre</th>
                    <th>Licenciatura</th>
                    <th>Centro Universitario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($alumnos) && count($alumnos) > 0)
                    @foreach ($alumnos as $alumno)
                    <tr>
                        <td>{{ $alumno->nombre }}</td>
                        <td>{{ $alumno->apellidos }}</td>
                        <td>{{ $alumno->correo_institucional }}</td>
                        <td>{{ $alumno->numero_cuenta }}</td>
                        <td>{{ $alumno->grupo ?? 'N/A' }}</td>
                        <td>{{ $alumno->semestre ?? 'N/A' }}</td>
                        <td>{{ $alumno->licenciatura }}</td>
                        <td>{{ $alumno->centro_universitario }}</td>
                        <td>
                            <form action="{{ route('aprobar.solicitud', $alumno->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success">Aprobar</button>
                            </form>
                            <form action="{{ route('rechazar.solicitud', $alumno->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Rechazar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9">No hay alumnos pendientes de aprobación.</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <!-- Solicitudes de Académicos -->
        <h2 class="mt-5" style="color: #004d40;">Solicitudes de Académicos</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Correo Institucional</th>
                    <th>Número de Cuenta</th>
                    <th>Centro Universitario</th>
                    <th>Licenciatura</th>
                    <th>Grupo</th>
                    <th>Cédula Profesional</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($academicos) && count($academicos) > 0)
                    @foreach ($academicos as $academico)
                        <tr>
                            <td>{{ $academico->nombre }}</td>
                            <td>{{ $academico->apellidos }}</td>
                            <td>{{ $academico->correo_institucional }}</td>
                            <td>{{ $academico->numero_cuenta }}</td>
                            <td>{{ $academico->centro_universitario }}</td>
                            <td>{{ $academico->licenciatura }}</td>
                            <td>{{ $academico->grupo ?? 'N/A' }}</td>
                            <td>{{ $academico->cedula_profesional }}</td>
                            <td>
                                <form action="{{ route('aprobar.solicitud', $academico->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Aprobar</button>
                                </form>
                                <form action="{{ route('rechazar.solicitud', $academico->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Rechazar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9">No hay académicos pendientes de aprobación.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
