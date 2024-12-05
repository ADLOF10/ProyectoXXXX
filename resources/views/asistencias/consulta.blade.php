<!-- resources/views/asistencias/consulta.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Asistencias</title>
    <link rel="stylesheet" href="{{ asset('css/stylesconsultas.css') }}">
    <style>
        .calendar, .table-container, .alumno-info { margin: 20px; }
        .table-container table { width: 100%; border-collapse: collapse; }
        .table-container th, .table-container td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        .attendance-percentage { font-weight: bold; color: #2ecc71; }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <img src="{{ asset('image.png') }}" alt="Logo Universidad">
            </div>
            <ul class="nav-links">
                <li><a href="http://127.0.0.1:8000/">Inicio</a></li>
                <li><a href="/nosotros">Nosotros</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Asistencias</h1>
        <div class="calendar">
            <!-- Implementación de un calendario simple -->
            <input type="date" id="fecha" name="fecha" value="{{ \Carbon\Carbon::now()->toDateString() }}">
        </div>

        @foreach($grupos as $grupo)
            <div class="grupo">
                <h2>Grupo: {{ $grupo->nombre_grupo }}</h2>
                <p>Materia: {{ $grupo->materia }}</p>
                <p>Profesor: {{ $grupo->profesor }}</p>

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No. Cuenta</th>
                                <th>Alumno</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Estado</th>
                                <th>Porcentaje de Asistencia</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($grupo->asistencias as $asistencia)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $asistencia->numero_cuenta }}</td>
                                    <td>{{ $asistencia->alumno->nombre }}</td>
                                    <td>{{ $asistencia->fecha }}</td>
                                    <td>{{ $asistencia->hora_registro }}</td>
                                    <td>{{ $asistencia->estado }}</td>
                                    <td class="attendance-percentage">
                                        {{ number_format($asistencia->porcentaje_asistencia, 2) }}%
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </main>

    <footer>
        <p>© 2024 Universidad - Todos los derechos reservados</p>
    </footer>
</body>
</html>
