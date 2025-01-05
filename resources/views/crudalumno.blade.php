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
        @if($alugrupos->isEmpty())
        <div class="alert alert-warning text-center">
            No hay registros asociados a tu correo institucional.
        </div>
         @else
    
        <table class="table table-bordered">
            <thead>
                <tr>
                    
                    <th>id</th>
                    <th>Grupo</th>
                    <th>Materia</th>
                    <th>Profesor</th>
                </tr>
            </thead>
            <tbody>
                @foreach($alugrupos as $alugrupo)
                <tr>
                    <td><a href="#" class="btn btn-info btn-sm"></a>{{ $alugrupo->id }}</td>
                    <td>{{ $alugrupo->nombre_grupo }}</td>
                    <td>{{ $alugrupo->materia }}</td>
                    <td>{{ $alugrupo->profesor}}</td>              
                </tr>
            @endforeach
            </tbody>
        </table>
        @endif
        </div>
     
  </section>
  @endsection