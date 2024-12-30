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
        <h1>Lista de Grupos</h1>

    
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    
        <table class="table table-bordered">
            <thead>
                <tr>
                    
                    <th>Nombre del Grupo</th>
                    <th>Materia</th>
                    <th>Profesor</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($grupos as $grupo)
                <tr>
                    
                    <td><a href="#" class="btn btn-info btn-sm">{{ $grupo->nombre_grupo }}</a></td>
                    <td>{{ $grupo->materia }}</td>
                    <td>{{ $grupo->profesor }}</td>
                    
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
     
  </section>
  @endsection