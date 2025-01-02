@extends('ventanapofe')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Configuración de QR</h1>
  </div>

  <div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h1>GRUPO: {{ $grupo->nombre_grupo }} {{ $grupo->materia }}. PROFESOR {{ $grupo->profesor }}</h1>

    @if(session('qrCode'))
    <div class="mt-4">
      <h2>Información Generada:</h2>
      <ul>
        <li><strong>Fecha de Clase:</strong> {{ session('fecha_clase') }}</li>
        <li><strong>Horario de Clase:</strong> {{ session('horario_clase') }} - {{ session('horario_clase_final') }}</li>
        <li><strong>Parámetros de Registro Activo:</strong> {{ session('horario_registro') }}</li>
        <li><strong>Fecha y Hora de Creación del QR:</strong> {{ session('fecha_hora_creacion') }}</li>
      </ul>

      <div id="qr-section">
        <div class="qr-code">
            {!! session('qrCode') !!}
        </div>
      </div>
    </div>
    @endif

    <div class="mt-5">
      <form action="{{ route('guardarQr', $grupo->id) }}" method="POST" style="display: inline-block;">
        @csrf
        
        <div class="mb-3">
            <label for="fecha_clase" class="form-label">Selecciona la Fecha de Clase</label>
            <input type="date" id="fecha_clase" name="fecha_clase" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="horario_inicio" class="form-label">Horario de Inicio</label>
            <input type="time" id="horario_inicio" name="horario_inicio" class="form-control" min="07:00" max="14:00" required>
        </div>

        <div class="mb-3">
            <label for="horario_fin" class="form-label">Horario de Finalización</label>
            <input type="time" id="horario_fin" name="horario_fin" class="form-control" min="07:00" max="14:00" required>
        </div>

        <div class="mb-3">
            <label for="registro_activo" class="form-label">Parámetros de Registro Activo</label>
            <div class="row">
                <div class="col-md-4">
                    <label for="asistencia" class="form-label">Asistencia</label>
                    <input type="number" id="asistencia" name="asistencia" class="form-control" value="5" min="0" required>
                </div>
                <div class="col-md-4">
                    <label for="retardo" class="form-label">Retardo</label>
                    <input type="number" id="retardo" name="retardo" class="form-control" value="10" min="0" required>
                </div>
                <div class="col-md-4">
                    <label for="inasistencia" class="form-label">Inasistencia</label>
                    <input type="number" id="inasistencia" name="inasistencia" class="form-control" value="15" min="0" required>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Generar Código QR</button>
      </form>

      <form action="{{ route('editarQr', $grupo->id) }}" method="POST" style="display: inline-block;">
        @csrf
        @method('PUT')
        <button type="submit" class="btn btn-warning">Editar QR</button>
      </form>

      <form action="{{ route('eliminarQr', $grupo->id) }}" method="POST" style="display: inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Eliminar QR</button>
      </form>
    </div>
  </div>
</section>

<script>
    // Eliminar lógica de múltiples fechas ya que solo se requiere una única fecha
</script>


<script>
    // Generar un calendario personalizado de lunes a sábado para cualquier mes y año desde hoy
    const calendarContainer = document.getElementById('fecha_clase');
    const selectedDatesInput = document.getElementById('selected_dates');
    const daysOfWeek = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];

    let currentYear = new Date().getFullYear();
    let currentMonth = new Date().getMonth();

    function renderCalendar(year, month) {
        const firstDayOfMonth = new Date(year, month, 1);
        let currentDay = firstDayOfMonth;
        let calendarHtml = '<div class="row">';

        while (currentDay.getMonth() === month) {
            const dayOfWeek = (currentDay.getDay() === 0 ? 7 : currentDay.getDay());

            // Solo mostrar de lunes (1) a sábado (6)
            if (dayOfWeek >= 1 && dayOfWeek <= 6) {
                const dateStr = currentDay.toISOString().split('T')[0];
                calendarHtml += `<div class="col-2 text-center">
                                    <label>
                                        <input type="checkbox" class="day-checkbox" value="${dateStr}">
                                        ${daysOfWeek[dayOfWeek - 1]}<br>
                                        ${currentDay.getDate()}/${month + 1}/${year}
                                    </label>
                                 </div>`;
            }

            currentDay.setDate(currentDay.getDate() + 1);
        }

        calendarHtml += '</div>';
        calendarContainer.innerHTML += calendarHtml;
    }

    // Renderizar el mes actual
    renderCalendar(currentYear, currentMonth);

    // Agregar funcionalidad para avanzar al siguiente mes
    const nextMonthButton = document.createElement('button');
    nextMonthButton.className = 'btn btn-link';
    nextMonthButton.addEventListener('click', (e) => {
        e.preventDefault();
        currentMonth += 1;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear += 1;
        }
        renderCalendar(currentYear, currentMonth);
    });
    calendarContainer.parentElement.appendChild(nextMonthButton);

    // Obtener los días seleccionados
    calendarContainer.addEventListener('change', () => {
        const selectedDates = Array.from(document.querySelectorAll('.day-checkbox:checked')).map(cb => cb.value);
        selectedDatesInput.value = selectedDates.join(',');
    });
</script>
@endsection
