<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olvidé mi Contraseña</title>
    <link rel="stylesheet" href="{{ asset('css/styleslogin.css') }}">
</head>
<body>
    <div class="login-container">
        <h1>Recuperar Contraseña</h1>
        <form action="{{ route('forgot-password.handle') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="correo_institucional">Correo Institucional</label>
                <input type="email" id="correo_institucional" name="correo_institucional" required>
            </div>

            <div class="form-group">
                <button type="submit">Enviar Enlace</button>
            </div>
        </form>
    </div>
</body>
<footer>
    <p>© 2024 Universidad - Todos los derechos reservados</p>
</footer>
</html>
