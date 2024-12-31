
@extends('ventanapofe')

@section('content')
<section class="section">
  <div class="section-header">
    <h1></h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
      <div class="breadcrumb-item">Profile</div>
    </div>
  </div>

  <div class="container">
    <h1>Lista de Grupos</h1>
    <a href="{{ route('crear-grupo') }}" class="btn btn-primary mb-3">Crear Nuevo Grupo</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Grupo</th>
                <th>Materia</th>
                <th>Profesor</th>
                <th>Generar qr para asistencia</th>
            </tr>
        </thead>
        <tbody>
            @foreach($grupos as $grupo)
            <tr>
                <td>{{ $grupo->id }}</td>
                <td>{{ $grupo->nombre_grupo }}</td>
                <td>{{ $grupo->materia }}</td>
                <td>{{ $grupo->profesor }}</td>
                <td>
                    <a href="{{ route('crearQr', $grupo->id) }}" class="btn btn-info btn-sm">crear qr</a>
                    <a href="#" class="btn btn-warning btn-sm">Editar</a>
                    <form action="#" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este grupo?')">Eliminar</button>
                    </form>

                    <form action="{{ route('crearQr', $grupo->id) }}" method="POST">
                        @csrf
                        <label for="campo_manual">Ingresa un dato manual:</label>
                        <input type="text" id="campo_manual" name="campo_manual" required>
                        <button type="submit">Generar QR</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    
</section>
@endsection