<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
</head>
<body>
    <p>Hola,</p>
    <p>Recibimos una solicitud para restablecer tu contraseña. Haz clic en el siguiente enlace para restablecerla:</p>
    <p>
        <a href="{{ url('reset-password/' . $token) }}">Restablecer Contraseña</a>
    </p>
    <p>Si no solicitaste este cambio, ignora este mensaje.</p>
</body>
</html>
