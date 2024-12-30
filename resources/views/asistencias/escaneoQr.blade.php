<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escaneo de QR</title>
    <link rel="stylesheet" href="{{ asset('css/stylesgeneracion.css') }}">
</head>
<body>
    <header>
        <h1>Escaneo de QR</h1>
    </header>
    <main>
        <form action="{{ route('registrarAsistencia') }}" method="POST">
            @csrf
            <label for="qr_code">Escanea el código QR:</label>
            <input type="text" id="qr_code" name="qr_code" placeholder="Ingrese el código QR" required>
            <button type="submit">Registrar Asistencia</button>
        </form>
        @if(session('message'))
            <p>{{ session('message') }}</p>
        @endif
    </main>
</body>
</html>
