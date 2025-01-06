@extends('ventanapofe')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Subir Lista de Alumnos</h1>
  </div>

  <div class="container">
    <h2>Sube un archivo CSV con la lista de alumnos</h2>
    <h3>El esquema del CSV: (nombre, apellidos, correo_institucional, numero_cuenta, grupo, semestre, licenciatura).</h3>
    <form action="{{ route('uploadAlumnos') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="file">Archivo CSV</label>
            <input type="file" id="file" name="file" class="form-control" accept=".csv" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Subir Archivo</button>
    </form>

    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
    @endif

    {{-- Mostrar mensaje si todos los alumnos son duplicados --}}
    @if(session('duplicados') && !session('alumnos'))
    <div class="alert alert-warning mt-3">
        <strong>Todos los alumnos a registrar ya están registrados, por favor sube otro archivo con más alumnos por registrar.</strong>
    </div>
    @endif

    {{-- Mostrar duplicados si existen y no todos son duplicados --}}
    @if(session('duplicados') && count(session('duplicados')) > 0 && session('alumnos'))
    <div class="alert alert-warning mt-3">
        <strong>Los siguientes alumnos ya están registrados:</strong>
        <ul>
            @foreach(session('duplicados') as $duplicado)
            <li>{{ $duplicado['nombre'] }} {{ $duplicado['apellidos'] }} - {{ $duplicado['correo_institucional'] }}</li>
            @endforeach
        </ul>
        <form action="{{ route('alumnos.deleteDuplicados') }}" method="POST" id="delete-duplicados-form">
            @csrf
            <button type="submit" class="btn btn-danger">Eliminar Duplicados</button>
        </form>
    </div>
    @endif

    {{-- Mostrar alumnos válidos --}}
    @if(session('alumnos') && count(session('alumnos')) > 0)
    <h3 class="mt-5">Lista de Alumnos para Registrar</h3>
    <form action="{{ route('alumnos.storeAll') }}" method="POST" id="register-form">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Correo Institucional</th>
                    <th>Número de Cuenta</th>
                    <th>Grupo</th>
                    <th>Semestre</th>
                    <th>Licenciatura</th>
                </tr>
            </thead>
            <tbody>
                @foreach(session('alumnos') as $index => $alumno)
                <tr>
                    <td><input type="checkbox" class="select-alumno" name="selected_alumnos[]" value="{{ $index }}"></td>
                    <td>{{ $alumno['nombre'] }}</td>
                    <td>{{ $alumno['apellidos'] }}</td>
                    <td>{{ $alumno['correo_institucional'] }}</td>
                    <td>{{ $alumno['numero_cuenta'] }}</td>
                    <td>{{ $alumno['grupo'] }}</td>
                    <td>{{ $alumno['semestre'] }}</td>
                    <td>{{ $alumno['licenciatura'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-success" id="register-button" {{ session('duplicados') && count(session('duplicados')) > 0 ? 'disabled' : '' }}>Registrar Alumnos</button>
    </form>
    @endif
  </div>
  
</section>

<script>
    // Seleccionar todos los checkboxes
    document.getElementById('select-all').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.select-alumno');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });

    // Deshabilitar botón Registrar Alumnos si hay duplicados
    const registerButton = document.getElementById('register-button');
    const deleteDuplicadosForm = document.getElementById('delete-duplicados-form');

    if (deleteDuplicadosForm) {
        deleteDuplicadosForm.addEventListener('submit', function (e) {
            e.preventDefault();
            fetch(this.action, {
                method: 'POST',
                body: new FormData(this),
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => {
                if (response.ok) {
                    alert('Duplicados eliminados correctamente. Ahora puedes registrar los alumnos.');
                    registerButton.disabled = false; // Habilitar el botón
                    deleteDuplicadosForm.parentElement.remove(); // Eliminar alerta de duplicados
                } else {
                    alert('Error al eliminar duplicados. Intenta de nuevo.');
                }
            }).catch(error => console.error(error));
        });
    }
</script>
@endsection
