<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aprobaciones</title>
    <link rel="stylesheet" href="{{ asset('css/aprobaciones.css') }}">
</head>
<body>
    <div class="container">
        <h1>Solicitudes de Aprobación</h1>
        @foreach ($solicitudes as $solicitud)
            <div class="solicitud">
                <h2>{{ $solicitud->user->nombre }} {{ $solicitud->user->apellidos }}</h2>
                <p>Correo: {{ $solicitud->user->correo_personal }}</p>
                <p>Licenciatura: {{ $solicitud->user->licenciatura }}</p>
                <p>Centro Universitario: {{ $solicitud->user->centro_universitario }}</p>
                <form action="{{ route('aprobaciones.aprobar', $solicitud->id) }}" method="POST">
                    @csrf
                    <button type="submit">Aprobar</button>
                </form>
                <form action="{{ route('aprobaciones.rechazar', $solicitud->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Rechazar</button>
                </form>
            </div>
        @endforeach
    </div>
</body>
</html>
