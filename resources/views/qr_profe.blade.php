@extends('ventanapofe')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Lista de Grupos</h1>
  </div>

  <div class="container">
    <a href="{{ route('crear-grupo') }}" class="btn btn-primary mb-3">Crear Nuevo Grupo</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre del Grupo</th>
                <th>Materia</th>
                <th>Profesor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($grupos as $grupo)
            <tr>
                <td>{{ $grupo->nombre_grupo }}</td>
                <td>{{ $grupo->materia }}</td>
                <td>{{ $grupo->profesor }}</td>
                <td>
                    <a href="{{ route('vistaQr', $grupo->id) }}" class="btn btn-primary">Configurar QR</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $grupos->links() }}
  </div>
</section>
@endsection
