<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Superusuario</title>
    <link rel="stylesheet" href="{{ asset('css/stylesdashsuper.css') }}">
</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="{{ asset('image.png') }}" alt="Logo Universidad">
        </div>
        <nav class="navbar">
            <ul class="nav-links">
                <li><a href="/login">Iniciar sesión</a></li>
                <li><a href="{{ route('aprobaciones') }}">Gestionar Aprobaciones</a></li>
                <li><a href="{{ route('registro.usuario') }}">Registrar Usuario</a></li>
                <li><a href="{{ route('logout') }}">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>

    <main class="main-container">
        <h1>Bienvenido, Superusuario</h1>
        <p class="description">Desde este panel puedes gestionar usuarios, aprobar registros y administrar las configuraciones del sistema.</p>

        <div class="action-buttons">
            <a href="{{ route('aprobaciones') }}" class="btn btn-primary">Gestionar Aprobaciones</a>
            <a href="{{ route('registro.usuario') }}" class="btn btn-secondary">Registrar Usuario</a>
            <a href="{{ route('logout') }}" class="btn btn-danger">Cerrar Sesión</a>
        </div>
    </main>

    <footer>
        <p>© 2024 Universidad - Todos los derechos reservados</p>
    </footer>
</body>
</html>
