<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aprobación de Registro</title>
</head>


<body>
    <h1>¡Hola, {{ $nombre }}!</h1>
    <p>Tu registro ha sido aprobado. Aquí están tus credenciales:</p>
    <ul>
        <li><strong>Correo Institucional:</strong> {{ $correoInstitucional }}</li>
        <li><strong>Número de Cuenta:</strong> {{ $numeroCuenta }}</li>
    </ul>
    <p>¡Bienvenido a nuestra comunidad!</p>
</body>
<footer>
    <p>© 2024 Universidad - Todos los derechos reservados</p>
</footer>
</html>
