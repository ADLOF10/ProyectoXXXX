<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Asistencias</title>
    <link rel="stylesheet" href="{{ asset('css/stylesgeneracion.css') }}">
</head>
<body>
    <header>
        <h1>Historial de Asistencias</h1>
    </header>
    <main>
        @if(count($asistencias) > 0)
            <ul>
                @foreach($asistencias as $asistencia)
                    <li>{{ $asistencia }}</li>
                @endforeach
            </ul>
        @else
            <p>No tienes asistencias registradas.</p>
        @endif
    </main>
</body>
</html>
