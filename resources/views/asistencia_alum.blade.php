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
        <h1>grafica de asistencias</h1>

    
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    
        
     
  </section>
  @endsection