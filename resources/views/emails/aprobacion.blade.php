<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credenciales Institucionales</title>
</head>
<body>
    <h1>¡Felicidades, {{ $nombre }}!</h1>

    <p>Tu solicitud de registro ha sido aprobada. A continuación, encontrarás tus credenciales de acceso:</p>

    <ul>
        <li><strong>Correo Institucional:</strong> {{ $correoInstitucional }}</li>
        <li><strong>Número de Cuenta:</strong> {{ $numeroCuenta }}</li>
    </ul>

    <p>Puedes utilizar estas credenciales para iniciar sesión en el sistema institucional.</p>

    <p>Si tienes alguna duda, no dudes en contactar al área administrativa.</p>

    <p>Saludos cordiales,</p>
    <p><strong>Equipo Institucional</strong></p>
</body>
<footer>
    <p>© 2024 Universidad - Todos los derechos reservados</p>
</footer>
</html>
