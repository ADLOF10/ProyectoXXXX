<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Generar Código QR</title>
    <link rel="stylesheet" href="{{ asset('css/stylesgeneracion.css') }}">
    
    <!-- Incluir la librería qrcode.js localmente o desde un CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</head>
<body>
    <!-- Header con barra de navegación -->
    <header>
        <nav class="navbar">
            <div class="logo">
                <img src="{{ asset('image.png') }}" alt="Logo Universidad">}
            </div>
            <ul class="nav-links">
                <li><a href="#home">Inicio</a></li>
                <li><a href="#servicios">Servicios</a></li>
                <li><a href="#contacto">Contacto</a></li>
                <li><a href="#nosotros">Nosotros</a></li>
            </ul>
        </nav>
    </header>

    <!-- Sección principal con formulario y botón de generación de QR -->
    <main>
        <section class="home-section">
            <h1>Registro de Asistencia por Grupo</h1>
            <p>Completa el formulario con la información del grupo antes de generar el código QR.</p>

            <!-- Contenedor para el formulario y el resumen -->
            <div class="form-qr-container">
                <!-- Formulario de información del grupo -->
                <form id="qrForm" action="{{ url('guardar-grupo') }}" method="POST" id="groupForm">
                {{-- <form action="{{ route('guardarGrupo') }}" method="POST"> --}}
                    @csrf
                    <div class="form-group">
                        <label for="nombreGrupo">Nombre del Grupo:</label>
                        <input type="text" id="nombreGrupo" name="nombreGrupo" required value="{{ old('nombreGrupo') }}"
                            pattern="^[A-Za-zÀ-ÿ\s]+$" title="Solo se permiten letras y espacios">
                    </div>
                    <div class="form-group">
                        <label for="materia">Materia:</label>
                        <input type="text" id="materia" name="materia" required value="{{ old('materia') }}"
                            pattern="^[A-Za-zÀ-ÿ\s]+$" title="Solo se permiten letras y espacios">
                    </div>
                    
                    <div class="form-group">
                        <label for="fechaClase">Fecha de la Clase:</label>
                        <input type="date" id="fechaClase" name="fechaClase" required value="{{ old('fechaClase') }}">
                    </div>

                    <div class="form-group">
                        <label for="profesor">Profesor:</label>
                        <input type="text" id="profesor" name="profesor" required value="{{ old('profesor') }}"
                            pattern="^[A-Za-zÀ-ÿ\s]+$" title="Solo se permiten letras y espacios">
                    </div>
                    <div class="form-group">
                        <label for="horarioClase">Horario de la Clase: </label>
                        <input type="time" id="horarioClase" name="horarioClase" required min="07:00" max="19:00" value="{{ old('horarioClase') }}">
                    </div>
                    <div class="form-group">
                        <label for="horarioClaseFinal">Horario de Clase Finalizada: </label>
                        <input type="time" id="horarioClaseFinal" name="horarioClaseFinal" required min="07:00" max="19:00" value="{{ old('horarioClaseFinal') }}">
                    </div>
                    <div class="form-group">
                        <label for="horarioRegistro">Fin de Horario de Registro Activo: </label>
                        <input type="time" id="horarioRegistro" name="horarioRegistro" required value="{{ old('horarioRegistro') }}">
                    </div>
                    <!-- Botón para generar código QR -->
                    <button type="submit" id="generateQRButton">Generar Código QR</button>
                </form>

                <!-- Resumen del código QR generado -->
                <div class="qr-summary">
                    <div id="qrContainer" class="qr-container" value="{{ old('qrContainer') }}"></div>
                    <p id="qrCodeText"></p>
                    <!-- Botón de descarga para el código QR -->
                <div class="qr-buttons">
                    <button id="downloadButton" style="display: none;">Descargar QR</button>
                    <button id="copyButton" style="display: none;">Copiar Código QR</button>
                </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>© 2024 Universidad - Todos los derechos reservados</p>
    </footer>


    
    <!-- Script para generar el código QR -->
    <script>
            document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("qrForm");

        form.addEventListener("submit", async function(event) {
            event.preventDefault(); // Evita que se recargue la página

            // Obtener los valores del formulario
            const nombreGrupo = document.getElementById("nombreGrupo").value;
            const materia = document.getElementById("materia").value;
            const fechaClase = document.getElementById("fechaClase").value;
            const profesor = document.getElementById("profesor").value;
            const horarioClase = document.getElementById("horarioClase").value;
            const horarioClaseFinal = document.getElementById("horarioClaseFinal").value;
            const horarioRegistro = document.getElementById("horarioRegistro").value;

            // Validar que el horario de registro esté dentro del rango de clase
            if (horarioRegistro < horarioClase || horarioRegistro > horarioClaseFinal) {
                alert("El horario de registro debe estar entre el horario de inicio y finalización de la clase.");
                return;
            }

            // Crear el texto para el código QR
            const qrData = `Grupo: ${nombreGrupo}\nMateria: ${materia}\nFecha: ${fechaClase}\nProfesor: ${profesor}\nHorario Clase: ${horarioClase}\nClase Finalizada: ${horarioClaseFinal}\nHorario Registro: ${horarioRegistro}`;

            // Mostrar la información generada en el texto
            document.getElementById("qrCodeText").innerText = `Datos del QR:\n${qrData}`;

            // Generar el código QR en el contenedor
            const qrContainer = document.getElementById("qrContainer");
            qrContainer.innerHTML = ""; // Limpiar cualquier QR anterior
            new QRCode(qrContainer, {
                text: qrData,
                width: 256,
                height: 256
            });

            // Mostrar los botones de descarga y copiar
            const downloadButton = document.getElementById("downloadButton");
            const copyButton = document.getElementById("copyButton");
            downloadButton.style.display = "inline-block";
            copyButton.style.display = "inline-block";

            // Función para convertir el QR a imagen PNG y descargar
            downloadButton.onclick = function() {
                const qrCanvas = qrContainer.querySelector("canvas");
                const qrImage = qrCanvas.toDataURL("image/png");

                const link = document.createElement("a");
                link.href = qrImage;
                link.download = "codigo_qr.png";
                link.click();
            };

            // Función para copiar el QR al portapapeles
            copyButton.onclick = async function() {
                try {
                    const qrCanvas = qrContainer.querySelector("canvas");
                    const blob = await new Promise(resolve => qrCanvas.toBlob(resolve, "image/png"));

                    // Usar Clipboard API para copiar la imagen
                    await navigator.clipboard.write([new ClipboardItem({ "image/png": blob })]);
                    alert("¡Código QR copiado al portapapeles!");
                } catch (error) {
                    console.error("Error al copiar el QR:", error);
                    alert("Error al copiar el código QR.");
                }
            };

            // Enviar los datos al servidor mediante AJAX
            try {
                const response = await fetch("{{ route('guardarGrupo') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                    },
                    body: JSON.stringify({
                        nombreGrupo,
                        materia,
                        fechaClase,
                        profesor,
                        horarioClase,
                        horarioClaseFinal,
                        horarioRegistro
                    })
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    console.error("Error del servidor:", errorData);
                    alert("Error al guardar los datos. Intenta nuevamente.");
                } else {
                    alert("¡Grupo registrado con éxito!");
                }
            } catch (error) {
                console.error("Error al realizar la solicitud:", error);
                alert("Error al guardar los datos. Verifica tu conexión o revisa el servidor.");
            }
        });
    });
    </script>
    



    {{-- <script>
        // Función para generar un UUID (Identificador único)
        function generarUUID() {
            return 'xxxxxxxx-xxxx-4xxx-\nyxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                var r = Math.random() * 16 | 0,
                    v = c === 'x' ? r : (r & 0x3 | 0x8);
                return v.toString(16);
            });
        }

        // Función para generar un código QR único basado en el formulario
        function generarCodigoQR(event) {
            event.preventDefault(); // Prevenir que el formulario se envíe

            // Limpiar cualquier QR anterior
            const qrContainer = document.getElementById('qrContainer');
            qrContainer.innerHTML = ''; // Limpiar el contenedor del QR

            // Obtener los datos del formulario
            const nombreGrupo = document.getElementById('nombreGrupo').value;
            const materia = document.getElementById('materia').value;
            const fechaClase = document.getElementById('fechaClase').value;
            const profesor = document.getElementById('profesor').value;
            const horarioClase = document.getElementById('horarioClase').value;
            const horarioClaseFinal = document.getElementById('horarioClaseFinal').value;
            const horarioRegistro = document.getElementById('horarioRegistro').value;

            // Validar que todos los campos estén llenos
            if (!nombreGrupo || !materia || !fechaClase || !profesor || !horarioClase || !horarioClaseFinal || !horarioRegistro) {
                alert('Por favor, completa todos los campos del formulario.');
                return;
            }

            // Generar UUID
            const uuid = generarUUID();

            // Crear una cadena de texto que combine los datos del grupo, el horario y el estado de asistencia
            const qrData = `Grupo: ${nombreGrupo}\nMateria: ${materia}\nFecha: ${fechaClase}\nProfesor: ${profesor}\nHorario Clase: ${horarioClase}\nClase Finalizada: ${horarioClaseFinal}\nHorario Registro: ${horarioRegistro}\nID: ${uuid}`;

            // Mostrar los datos generados del QR
            document.getElementById('qrCodeText').innerText = `Datos del QR:\n${qrData}`;

            // Generar el código QR con la librería qrcode.js
            new QRCode(qrContainer, {
                text: qrData,
                width: 256,  // Ancho del código QR
                height: 256  // Alto del código QR
            });
        }

        // Añadir el evento al formulario para generar el código QR al enviarlo
        document.getElementById('groupForm').addEventListener('submit', generarCodigoQR);
    </script> --}}

    {{-- <script>
    // Establecer la fecha mínima a hoy
    const today = new Date().toISOString().split('T')[0];
    document.getElementById("fechaClase").setAttribute("min", today);
    </script>

    <script>
        document.getElementById('groupForm').addEventListener('submit', function(event) {
            const horarioClase = document.getElementById('horarioClase').value;
            const horarioClaseFinal = document.getElementById('horarioClaseFinal').value;
            const horarioRegistro = document.getElementById('horarioRegistro').value;

            // Verifica si el horario de registro está dentro del rango de inicio y fin de clase
            if (horarioRegistro < horarioClase || horarioRegistro > horarioClaseFinal) {
                alert('El Horario de Registro Activo debe estar entre el Horario de la Clase y el Horario de Clase Finalizada.');
                event.preventDefault(); // Prevenir el envío del formulario
            }
        });
    </script> --}}

    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            const elemento = document.getElementById("idDelElemento"); // Cambia "idDelElemento" por el id real
            if (elemento) {
                elemento.addEventListener("click", function() {
                    // Tu código aquí
                });
            }
        });
    </script> --}}


</body>
</html>
