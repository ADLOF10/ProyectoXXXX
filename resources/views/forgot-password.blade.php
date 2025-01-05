<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Recuperar Contraseña</h2>
    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="correo_personal">Correo Electrónico</label>
            <input type="email" id="correo_personal" name="correo_personal" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Enviar Enlace de Recuperación</button>
    </form>

    @if(session('status'))
        <div class="alert alert-success mt-3">{{ session('status') }}</div>
    @endif
</div>
</body>
</html>
