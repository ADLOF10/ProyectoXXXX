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
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Correo Institucional</th>
                    <th>Número de Cuenta</th>
                    <th>Semestre</th>
                    <th>Licenciatura</th>
                </tr>
            </thead>
            <tbody>
                @foreach($alumnos as $alumno)
                <tr>
                    <td>{{ $alumno->nombre }}</td>
                    <td>{{ $alumno->apellidos }}</td>
                    <td>{{ $alumno->correo_institucional }}</td>
                    <td>{{ $alumno->numero_cuenta }}</td>
                    <td>{{ $alumno->semestre }}</td>
                    <td>{{ $alumno->licenciatura }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection
