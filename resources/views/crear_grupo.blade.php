
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
<!-- formulario para crear un grupo-->
<div class="container">
    <h1>Crear Nuevo Grupo</h1>
    <form action="{{ route('guardarGru') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre_grupo" class="form-label">Clave</label>
            <input type="text" name="nombre_grupo" class="form-control" id="nombre_grupo" required>
        </div>
        <div class="mb-3">
            <label for="materia" class="form-label">Materia</label>
            <input type="text" name="materia" class="form-control" id="materia"  required>
        </div>
        <div class="mb-3">
            <label for="clave" class="form-label">Nombre Grupo</label>
            <input type="text" name="clave" class="form-control" id="clave" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('consultarGru') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</section>
@endsection