<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/stylesgeneracion.css') }}">
</head>
<body>
    <!-- Header -->
    <header>
        <nav class="navbar">
            <div class="logo">
                <img src="{{ asset('image.png') }}" alt="Logo Universidad">
            </div>
            <ul class="nav-links">
                <li><a href="#home">Inicio</a></li>
                <li><a href="#perfil">Perfil</a></li>
                @if(auth()->user()->tipo === 'profesor')
                <li><a href="#generarQr">Generar QR</a></li>
                @endif
                @if(auth()->user()->tipo === 'alumno')
                <li><a href="#escaneoQr">Escanear QR</a></li>
                @endif
                <li>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-button">Cerrar Sesión</button>
                    </form>
                </li>
            </ul>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        <section id="home" class="home-section">
            <h1>Bienvenido, {{ auth()->user()->name }}</h1>
            <p>Panel de control para 
                @if(auth()->user()->tipo === 'profesor') profesores 
                @elseif(auth()->user()->tipo === 'alumno') alumnos 
                @else superusuario 
                @endif
            </p>
        </section>

        <!-- Contenido para el profesor -->
        @if(auth()->user()->tipo === 'profesor')
        <section id="generarQr" class="dashboard-section">
            <h2>Generar Código QR</h2>
            <p>Como profesor, puedes generar códigos QR para registrar la asistencia de tus alumnos.</p>
            <a href="{{ route('registroGrupo') }}" class="button">Generar QR</a>
        </section>

        <section id="asistencias" class="dashboard-section">
            <h2>Asistencias</h2>
            <p>Consulta las asistencias de tus grupos registrados.</p>
            <a href="{{ route('consultaAsistencias') }}" class="button">Ver Asistencias</a>
        </section>
        @endif

        <!-- Contenido para el alumno -->
        @if(auth()->user()->tipo === 'alumno')
        <section id="escaneoQr" class="dashboard-section">
            <h2>Escanear Código QR</h2>
            <p>Como alumno, puedes escanear el código QR para registrar tu asistencia.</p>
            <a href="{{ route('escaneoQr') }}" class="button">Escanear QR</a>
        </section>

        <section id="historial" class="dashboard-section">
            <h2>Historial de Asistencias</h2>
            <p>Consulta tu historial de asistencias registradas.</p>
            <a href="{{ route('historialAsistencias') }}" class="button">Ver Historial</a>
        </section>
        @endif

        <!-- Contenido para el superusuario -->
        @if(auth()->user()->tipo === 'superusuario')
        <section id="aprobaciones" class="dashboard-section">
            <h2>Aprobaciones Pendientes</h2>
            <p>Gestiona las solicitudes de registro de nuevos usuarios.</p>
            <a href="{{ route('listarSolicitudes') }}" class="button">Ver Solicitudes</a>
        </section>
        @endif
    </main>

    <footer>
        <p>© 2024 Universidad - Todos los derechos reservados</p>
    </footer>

    <!-- Estilos Personalizados -->
    <style>
        .dashboard-section {
            padding: 20px;
            text-align: center;
            margin: 20px auto;
            max-width: 800px;
            background-color: #f5f5f5;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .dashboard-section h2 {
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .dashboard-section p {
            color: #34495e;
            margin-bottom: 20px;
        }

        .dashboard-section .button {
            display: inline-block;
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .dashboard-section .button:hover {
            background-color: #2980b9;
        }

        .logout-button {
            background-color: #e74c3c;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }

        .logout-button:hover {
            background-color: #c0392b;
        }
    </style>
</body>
</html>
