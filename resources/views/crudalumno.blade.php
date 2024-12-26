
@extends('ventanaalum')

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
      <h1>grupos a los que perteneces </h1>
      <a href="#" class="btn btn-primary mb-3">registra asistencia</a>
  
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
                  <th>Acciones</th>
              </tr>
          </thead>
          <tbody>
              
                  <tr>
                      <td>id</td>
                      <td>nombre grupo</td>
                      <td>materia</td>
                      <td>profesor</td>
                      <td>
                          <a href="#" class="btn btn-info btn-sm">Ver</a>
                          <a href="#" class="btn btn-warning btn-sm">Editar</a>
                          <form action="#" method="POST" style="display: inline-block;">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este grupo?')">Eliminar</button>
                          </form>
                      </td>
                  </tr>
              
          </tbody>
      </table>
      </div>
      <h1>registra asistencia</h1>   

      <div class="container">
          <h1>Detalles del Grupo</h1>
          <div class="card">
              <div class="card-body">
                  <h5 class="card-title">Nombre del Grupo: </h5>
                  <p class="card-text">Materia: </p>
                  <p class="card-text">Profesor: </p>
                  <a href="#" class="btn btn-secondary">Volver</a>
              </div>
          </div>
      </div>

      <h1>grafica de asistencias </h1>


  </section>
  @endsection