
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
    <h1>Código QR del Grupo: {{ $grupo->nombre_grupo }}</h1>
    <div class="mb-3">
        <p>Materia: {{ $grupo->materia }}</p>
        <p>Profesor: {{ $grupo->profesor }}</p>
    </div>
    <div class="qr-code">
        {!! $qrCode !!}
    </div>
    <a href="{{ route('verGrupo') }}" class="btn btn-secondary">Volver a la lista</a>
</div>
</section>
@endsection