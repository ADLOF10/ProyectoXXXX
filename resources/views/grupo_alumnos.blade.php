@extends('ventanapofe')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Lista de Alumnos del Grupo</h1>
    </div>

    <div class="container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre alumno</th>
                    <th>Grupo</th>
                    <th>Materia</th>
                    <th>Profesor</th>
                </tr>
            </thead>
            <tbody>
                @foreach($alumnos as $alumno)
                <tr>
                    <td>{{ $alumno->alumno_nombre }}</td>
                    <td>{{ $alumno->nombre_grupo }}</td>
                    <td>{{ $alumno->materia }}</td>
                    <td>{{ $alumno->profesor }}</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection
