
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

  @if(session('success'))
  <div class="alert alert-success">
      {{ session('success') }}
  </div>
  @endif
<!-- formulario para modificar un grupo-->


<div class="container">
        <h1>Editar Grupo</h1>
        <form action="{{ route('grupos.update', $grupo) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nombre_grupo" class="form-label">Nombre del Grupo</label>
                <input type="text" name="nombre_grupo" class="form-control" id="nombre_grupo" value="{{ $grupo->nombre_grupo }}" required>
            </div>
            <div class="mb-3">
                <label for="materia" class="form-label">Materia</label>
                <input type="text" name="materia" class="form-control" id="materia" value="{{ $grupo->materia }}" required>
            </div>
            <div class="mb-3">
                <label for="profesor" class="form-label">Profesor</label>
                <input type="text" name="profesor" class="form-control" id="profesor" value="{{ $grupo->profesor }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="#" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

</div>
</section>
@endsection