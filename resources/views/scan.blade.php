<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QRSCANN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    
    <div class="container col-lg-6 py-4">
        {{-- Scanner--}}
        <div class="card bg-white shadow rounded-3 p-3 border-0">
            <video id="preview"></video>  
             {{-- form--}}
             <form action="{{ route('store') }}" method="POST" id="form">
                @csrf
                <input type="hidden" name="nombre_grupo" id="nombre_grupo">
                <input type="hidden" name="materia" id="materia">
                <input type="hidden" name="profesor" id="profesor">
             </form>
             
        </div>
    </div>
    
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script type="text/javascript">
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
scanner.addListener('scan', function (content) {
  console.log(content);  // Muestra el contenido escaneado en la consola

  // Supongamos que el contenido está separado por saltos de línea
  let data = content.split('\n');

  // Verifica si hay al menos tres líneas para asignar a los campos
  if (data.length >= 3) {
    document.getElementById('nombre_grupo').value = data[0];  // Asigna la primera línea a 'nombre_grupo'
    document.getElementById('materia').value = data[1];       // Asigna la segunda línea a 'materia'
    document.getElementById('profesor').value = data[2];      // Asigna la tercera línea a 'profesor'
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
  </body>
</html>