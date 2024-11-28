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
                <input type="text" id="nombre" name="nombre" required>
            </div>

            <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" required>
            </div>

            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
            </div>

            <div class="form-group">
                <label for="genero">Género:</label>
                <select id="genero" name="genero" required>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>

            <div class="form-group">
                <label for="correo_personal">Correo Personal:</label>
                <input type="email" id="correo_personal" name="correo_personal" required>
            </div>

            <div class="form-group">
                <label for="licenciatura">Licenciatura:</label>
                <input type="text" id="licenciatura" name="licenciatura" required>
            </div>

            <div class="form-group">
                <label for="centro_universitario">Centro Universitario:</label>
                <input type="text" id="centro_universitario" name="centro_universitario" required>
            </div>

            <div class="form-group checkbox-group">
                <input type="checkbox" id="es_academico" name="es_academico" onchange="toggleAcademicoFields()">
                <label for="es_academico">Soy Académico</label>
            </div>

            <div id="academico-fields" style="display: none;">
                <div class="form-group">
                    <label for="cedula_profesional">Cédula Profesional:</label>
                    <input type="text" id="cedula_profesional" name="cedula_profesional">
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
