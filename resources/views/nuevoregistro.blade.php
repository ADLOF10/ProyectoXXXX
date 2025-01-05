<!DOCTYPE html>
<html lang="es">
<head>



    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="{{ asset('css/stylesregistro.css') }}">
    <script>
        function toggleAcademicoFields() {
            const esAcademico = document.getElementById('es_academico').checked;
            const academicoFields = document.getElementById('academico-fields');
            academicoFields.style.display = esAcademico ? 'block' : 'none';
        }
    </script>
</head>
    <!-- Header con barra de navegación -->
    <header>
        <nav class="navbar">
            <div class="logo">
                <img src="{{ asset('image.png') }}" alt="Logo Universidad">
            </div>
            <ul class="nav-links">
                <li><a href="/login">Iniciar sesion</a></li>
                <li><a href="/nosotros">Nosotros</a></li>
            </ul>
        </nav>
    </header>
<body>
    <div class="form-container">
        <h1>Registro de Usuario</h1>
        @if(session('success'))
            <p class="success-message">{{ session('success') }}</p>
        @endif
        <form action="{{ route('registro.usuario.handle') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    value="{{ old('nombre') }}"
                    required
                    class="@error('nombre') is-invalid @enderror"
                >
                @if ($errors->has('nombre'))
                    <span class="text-danger">{{ $errors->first('nombre') }}</span>
                @endif
            </div>


            <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <input
                    type="text"
                    id="apellidos"
                    name="apellidos"
                    value="{{ old('apellidos') }}"
                    required
                    class="@error('apellidos') is-invalid @enderror"
                >
                @if ($errors->has('apellidos'))
                    <span class="text-danger">{{ $errors->first('apellidos') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="correo_personal">Correo Personal:</label>
                <input
                    type="email"
                    id="correo_personal"
                    name="correo_personal"
                    value="{{ old('correo_personal') }}"
                    required
                    class="@error('correo_personal') is-invalid @enderror"
                >
                @if ($errors->has('correo_personal'))
                    <span class="text-danger">{{ $errors->first('correo_personal') }}</span>
                @endif

            </div>

            <div class="form-group">
                <label for="correo_institucional">Correo Institucional:</label>
                <input
                    type="email"
                    id="correo_institucional"
                    name="correo_institucional"
                    value="{{ old('correo_institucional') }}"
                    required
                    class="@error('correo_institucional') is-invalid @enderror"
                >
                @if ($errors->has('correo_institucional'))
                    <span class="text-danger">{{ $errors->first('correo_institucional') }}</span>
                @endif

            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    value="{{ old('password') }}"
                    required
                    class="@error('password') is-invalid @enderror"

                >
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="form-group checkbox-group">
                <input type="checkbox" id="es_academico" name="es_academico" onchange="toggleAcademicoFields()">
                <label for="es_academico">Soy Académico</label>
            </div>

            <div id="academico-fields" style="display: none;">
                <div class="form-group">
                    <label for="cedula_profesional">Cédula Profesional:</label>
                    <input type="text" id="cedula_profesional" name="cedula_profesional" value="{{ old('cedula_profesional') }}"
                    class="@error('cedula_profesional') is-invalid @enderror">
                    @if ($errors->has('cedula_profesional'))
                    <span class="text-danger">{{ $errors->first('cedula_profesional') }}</span>
                    @endif
                </div>
            </div>


            <button type="submit">Registrar</button>
        </form>
    </div>
</body>
{{-- <script>
    function toggleAcademicoFields() {
        const checkbox = document.getElementById("es_academico");
        const roleField = document.getElementById("role");

        if (checkbox.checked) {
            roleField.value = "academico";
        } else {
            roleField.value = "alumno";
        }
    }
</script> --}}
</html>
