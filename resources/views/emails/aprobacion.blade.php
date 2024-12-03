<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credenciales Institucionales</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333;">
    <h1>Hola {{ $nombreCompleto }}</h1>
    <p>
        ¡Felicidades! Tu cuenta institucional ha sido aprobada. A continuación, te proporcionamos tus credenciales:
    </p>
    <ul>
        <li><strong>Correo Institucional:</strong> {{ $correoInstitucional }}</li>
        <li><strong>Número de Cuenta:</strong> {{ $numeroCuenta }}</li>
    </ul>
    <p>
        Por favor, utiliza esta información para iniciar sesión en nuestra plataforma.
    </p>
    <p>Gracias,</p>
    <p><strong>Equipo Administrativo</strong></p>
</body>
</html>
