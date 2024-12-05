<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumno</title>
    <link rel="stylesheet" href="{{ asset('css/stylesmaestro.css') }}">
</head>
<header>
    <nav class="navbar">
        <div class="logo">
            <img src="{{ asset('image.png') }}" alt="Logo Universidad">
        </div>
        <ul class="nav-links">
            <li><a href="/">Inicio</a></li>
            <li><a href="/asistencias">Ver mis Asistencias</a></li>
            <li><a href="/nosotros">Nosotros</a></li>
            <!-- Botón de Cerrar Sesión -->
            <li>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
                </form>
            </li>
        </ul>
    </nav>
</header>
</head>
<body>

</body>
<footer>
    <p>© 2024 Universidad - Todos los derechos reservados</p>
</footer>
</html>
