<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Aprobaciones</title>
    <link rel="stylesheet" href="{{ asset('css/stylesdashsuper.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Panel de Administración</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
