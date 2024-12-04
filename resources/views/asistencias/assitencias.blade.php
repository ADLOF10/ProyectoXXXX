<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Asistencias</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <header>
        <h1>Consulta de Asistencias por Grupo</h1>
    </header>

    <main>
        <div class="container">
            @foreach($asistencias as $grupo)
                <div class="grupo">
                    <h2>Grupo: {{ $grupo->nombre_grupo }}</h2>
                    <p>Materia: {{ $grupo->materia }}</p>
                    <p>Profesor: {{ $grupo->profesor }}</p>
                    <p>Fecha de Clase: {{ $grupo->fecha_clase }}</p>

                    <table>
                        <thead>
                            <tr>
                                <th>Alumno</th>
                                <th>Hora de Entrada</th>
                                <th>Hora de Salida</th>
                                <th>Estado de Asistencia</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($grupo->asistencias as $asistencia)
                                <tr>
                                    <td>{{ $asistencia->alumno->nombre }}</td>
                                    <td>{{ $asistencia->hora_entrada }}</td>
                                    <td>{{ $asistencia->hora_salida }}</td>
                                    <td>{{ $asistencia->estado }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </main>

    <footer>
        <p>© 2024 Universidad - Todos los derechos reservados</p>
    </footer>
</body>
</html>
