<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="{{ asset('css/styleslogin.css') }}">
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5/8b7d1y59EZiTVa7FhI1WWhzV8dRl62rKj32wPu" crossorigin="anonymous">

</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <img src="{{ asset('image.png') }}" alt="Logo Universidad">
            </div>
            <ul class="nav-links">
                <li><a href="/">Inicio</a></li>
                <li><a href="/registro-usuario">Registrarse</a></li>
                <li><a href="/nosotros">Nosotros</a></li>
            </ul>
        </nav>
    </header>
    
    <div class="login-container">
        <h1>Inicia Sesión</h1>
        
        @if ($errors->any())
                <div class="alert alert-warning mt-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        <form method="POST" action="{{ route('login.handle') }}">
            @csrf
            <div class="form-group">
                <label for="correo_personal">Correo Personal</label>
                <input id="correo_personal" type="email" class="form-control @error('correo_personal') is-invalid @enderror" name="correo_personal" value="{{ old('correo_personal') }}" required autocomplete="email" placeholder="usuario@alumno.universidad.mx" autofocus>
                @error('correo_personal')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Ingresa tu contraseña" autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
            </div>
        </form>

        <div class="extra-links">
            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
            @endif
        </div> 
    </div>

    <footer>
        <p>© 2024 Universidad - Todos los derechos reservados</p>
    </footer>
</body>
</html>
