<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="{{ asset('css/stylesgeneracion.css') }}">
    <script src="{{ asset('js/scripts.js') }}"></script>
</head>
<body>
    <header>
        <h1>Formulario de Registro</h1>
    </header>

    <main>
        <form id="registerForm" action="{{ route('solicitarRegistro') }}" method="POST">
            @csrf
            <!-- Campos Generales -->
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>

            <div class="form-group">
                <label for="apellido_paterno">Apellido Paterno:</label>
                <input type="text" id="apellido_paterno" name="apellido_paterno" required>
            </div>

            <div class="form-group">
                <label for="apellido_materno">Apellido Materno:</label>
                <input type="text" id="apellido_materno" name="apellido_materno" required>
            </div>

            <div class="form-group">
                <label for="centro_educativo">Centro Educativo:</label>
                <input type="text" id="centro_educativo" name="centro_educativo" required>
            </div>

            <div class="form-group">
                <label for="licenciatura">Licenciatura Aplicada:</label>
                <input type="text" id="licenciatura" name="licenciatura" required>
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
                <label for="correo_personal">Correo Electrónico Personal:</label>
                <input type="email" id="correo_personal" name="correo_personal" required>
            </div>

            <div class="form-group">
                <label for="telefono">Número Celular:</label>
                <input type="tel" id="telefono" name="telefono" required>
            </div>

            <div class="form-group">
                <label for="domicilio">Domicilio:</label>
                <textarea id="domicilio" name="domicilio" required></textarea>
            </div>

            <!-- Selección de Tipo de Usuario -->
            <div class="form-group">
                <label for="tipo_usuario">Tipo de Usuario:</label>
                <select id="tipo_usuario" name="tipo_usuario" required>
                    <option value="alumno">Alumno</option>
                    <option value="profesor">Profesor</option>
                </select>
            </div>

            <!-- Campos Exclusivos para Profesores -->
            <div id="campos_profesor" style="display: none;">
                <div class="form-group">
                    <label for="matricula">Matrícula:</label>
                    <input type="text" id="matricula" name="matricula">
                </div>

                <div class="form-group">
                    <label for="departamento">Carrera/Departamento:</label>
                    <input type="text" id="departamento" name="departamento">
                </div>
            </div>

            <!-- Aceptación de Políticas -->
            <div class="form-group">
                <label>
                    <input type="checkbox" name="politicas" required>
                    Acepto las políticas de uso de correo institucional.
                </label>
            </div>

            <button type="submit">Solicitar Registro</button>
        </form>
    </main>

    <script>
        document.getElementById('tipo_usuario').addEventListener('change', function() {
            const tipo = this.value;
            const camposProfesor = document.getElementById('campos_profesor');
            if (tipo === 'profesor') {
                camposProfesor.style.display = 'block';
            } else {
                camposProfesor.style.display = 'none';
            }
        });
    </script>
</body>
</html>
