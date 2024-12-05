<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Aprobaciones</title>
    <link rel="stylesheet" href="{{ asset('css/stylesdashsuper.css') }}">
</head>
<body>
    <div class="container">
        <h1 class="text-center" style="color: #004d40;">Gestión de Aprobaciones</h1>
    
        <!-- Tabla de Alumnos -->
        <h2 class="mt-5" style="color: #004d40;">Solicitudes de Alumnos</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Correo Personal</th>
                    <th>Centro Universitario</th>
                    <th>Licenciatura</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($alumnos) && count($alumnos) > 0)
                    @foreach ($alumnos as $alumno)
                    <tr>
                        <td>{{ $alumno->nombre }}</td>
                        <td>{{ $alumno->apellidos }}</td>
                        <td>{{ $alumno->correo_personal }}</td>
                        <td>{{ $alumno->centro_universitario }}</td>
                        <td>{{ $alumno->licenciatura }}</td>
                        <td>
                            <!-- Botón Aprobar -->
                            <form action="{{ route('aprobar.solicitud', $alumno->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success">Aprobar</button>
                            </form>
                            <!-- Botón Rechazar -->
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
                        <td colspan="6" class="text-center">No hay solicitudes pendientes de alumnos.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    
        <!-- Tabla de Académicos -->
        <h2 class="mt-5" style="color: #004d40;">Solicitudes de Académicos</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Correo Personal</th>
                    <th>Centro Universitario</th>
                    <th>Licenciatura</th>
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
                        <td>{{ $academico->correo_personal }}</td>
                        <td>{{ $academico->centro_universitario }}</td>
                        <td>{{ $academico->licenciatura }}</td>
                        <td>{{ $academico->cedula_profesional }}</td>
                        <td>
                            <!-- Botón Aprobar -->
                            <form action="{{ route('aprobar.solicitud', $academico->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success">Aprobar</button>
                            </form>
                            <!-- Botón Rechazar -->
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
                        <td colspan="7" class="text-center">No hay solicitudes pendientes de académicos.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>    
</body>
</html>
