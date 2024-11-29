<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="{{ asset('css/styleslogin.css') }}">
</head>
<body>
    <div class="login-container">
        <h1>Inicia Sesión</h1>
        <form action="{{ route('login.handle') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="correo_institucional">Correo Institucional</label>
                <input type="email" id="correo_institucional" name="correo_institucional" required placeholder="usuario@alumno.universidad.mx">
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required placeholder="Ingresa tu contraseña">
            </div>

            <div class="form-group">
                <button type="submit">Iniciar Sesión</button>
            </div>
        </form>

        <div class="extra-links">
            <a href="{{ route('forgot-password') }}">¿Olvidaste tu contraseña?</a>
        </div>
    </div>
</body>
</html>
