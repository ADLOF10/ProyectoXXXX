<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escanear Código QR</title>
</head>
<body>
    <h1>Escanear Código QR</h1>
    <div id="qr-reader" style="width: 500px; height: 500px;"></div>
    <p id="resultado" style="font-size: 18px; font-weight: bold;"></p>
    
    <script>
        // Configuración y arranque del escáner de QR
        function onScanSuccess(decodedText, decodedResult) {
            // Mostrar la información decodificada en un párrafo
            document.getElementById('resultado').innerText = `Información del QR: ${decodedText}`;
            // Detener el escáner después de leer un código QR
            html5QrcodeScanner.clear();
        }

        function onScanError(errorMessage) {
            // Puedes dejar este espacio vacío o mostrar un mensaje si ocurre algún error
            console.error(errorMessage);
        }

        // Inicializar el escáner de QR
        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", {
                fps: 10,
                qrbox: 250
            });
        
        // Iniciar el escaneo
        html5QrcodeScanner.render(onScanSuccess, onScanError);
    </script>
</body>
</html>
