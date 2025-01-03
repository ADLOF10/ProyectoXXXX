
@extends('ventanaalum')

@section('content')
<section class="section">
    <div class="section-header">
    
    <div class="container col-lg-6 py-4">

      @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

        {{-- Scanner--}}
        <div class="card bg-white shadow rounded-3 p-3 border-0">
            <video id="preview"></video>  
             {{-- form--}}
             <form action="{{ route('store') }}" method="POST" id="form">
                @csrf
                <input type="hidden" name="grupo" id="grupo">
                <input type="hidden" name="materia" id="materia">
                <input type="hidden" name="profesor" id="profesor">
                <input type="hidden" name="fecha" id="fecha">
                <input type="hidden" name="hora_registro" id="hora_registro">
                <input type="hidden" name="hora_registro_fin" id="hora_registro_fin">
                <input type="hidden" name="asistencia" id="asistencia">
                <input type="hidden" name="retardo" id="retardo">
                <input type="hidden" name="falta" id="falta">
                <input type="hidden" name="fecha_hora_actual" id="fecha_hora_actual">
                <input type="hidden" name="id_grupo" id="id_grupo">

             </form>
             
        </div>
    </div>

    <div class="container col-lg-6 py-4">
          <a href="{{ route('dash.alum') }}" class="btn btn-info btn-sm">Regresar</a>
    </div>
    
            <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
            <script type="text/javascript">
                let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        scanner.addListener('scan', function (content) {
          console.log(content);  // Muestra el contenido escaneado en la consola

          // Supongamos que el contenido está separado por saltos de línea
          let data = content.split('\n');

          // Verifica si hay al menos tres líneas para asignar a los campos
          if (data.length >= 9) {
              // Asigna la primera línea a 'nombre_grupo'
            document.getElementById('grupo').value = data[0];       // Asigna la segunda línea a 'materia'
            document.getElementById('materia').value = data[1];      // Asigna la tercera línea a 'profesor'
            document.getElementById('profesor').value = data[2];
            document.getElementById('fecha').value = data[3];       // Asigna la segunda línea a 'materia'
            document.getElementById('hora_registro').value = data[4];
            document.getElementById('hora_registro_fin').value = data[7];      // Asigna la tercera línea a 'profesor'
            document.getElementById('asistencia').value = data[6];
            document.getElementById('retardo').value = data[7];      // Asigna la tercera línea a 'profesor'
            document.getElementById('falta').value = data[8];
            document.getElementById('fecha_hora_actual').value = data[9];
            document.getElementById('id_grupo').value = data[10];
            
          }

          // Luego, se envía el formulario
          document.getElementById('form').submit();
        });

        Instascan.Camera.getCameras().then(function (cameras) {
          if (cameras.length > 0) {
            scanner.start(cameras[0]);
          } else {
            console.error('No cameras found.');
          }
        }).catch(function (e) {
          console.error(e);
        });

              </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
          </section>
          @endsection
       