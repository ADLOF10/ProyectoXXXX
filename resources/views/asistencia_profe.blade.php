@extends('ventanapofe')

@section('content')

<section class="section">
    <div class="section-header">
        <h1></h1>
        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#"></a></div>
        <div class="breadcrumb-item"></div>
        </div>
    </div>
 
                <div class="container mt-5">
                    <h1 class="text-center">Gráfica de Asistencias</h1>
                
                    <!-- Formulario para buscar -->
                    <form action="{{ route('attendance.filtered') }}" method="POST" class="mb-5">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="grupo" class="form-label">Nombre del Grupo:</label>
                                <input type="text" id="grupo" name="grupo" class="form-control" placeholder="Ej: Grupo A" required>
                            </div>
                            <div class="col-md-6">
                                <label for="alumno" class="form-label">Nombre del Alumno:</label>
                                <input type="text" id="alumno" name="alumno" class="form-control" placeholder="Ej: Juan Pérez" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Generar Gráfica</button>
                    </form>
         <div class="card bg-white shadow rounded-3 p-3 border-0">
                    <!-- Gráfica -->
                    @if(!empty($percentages))
                    <h2 class="text-center">Asistencias de {{ $alumno }} en {{ $grupo }}</h2>
                    <canvas id="attendanceChart" width="10" height="5"></canvas>
                    <script>
                        const percentages = @json($percentages);
                        const ctx = document.getElementById('attendanceChart').getContext('2d');
                        new Chart(ctx, {
                            type: 'bar', // Cambio a gráfico de barras
                            data: {
                                labels: ['Asistencias', 'Retardos', 'Faltas'],
                                datasets: [{
                                    label: 'Porcentaje',
                                    data: [percentages.asistencias, percentages.retardos, percentages.faltas],
                                    backgroundColor: [
                                        'rgba(75, 192, 192, 0.6)', // Asistencias
                                        'rgba(255, 206, 86, 0.6)', // Retardos
                                        'rgba(255, 99, 132, 0.6)', // Faltas
                                    ],
                                    borderColor: [
                                        'rgba(75, 192, 192, 1)', // Asistencias
                                        'rgba(255, 206, 86, 1)', // Retardos
                                        'rgba(255, 99, 132, 1)', // Faltas
                                    ],
                                    borderWidth: 1,
                                }],
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'top',
                                    },
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        title: {
                                            display: true,
                                            text: 'Porcentaje (%)',
                                        },
                                    },
                                },
                            },
                        });
                    </script>
                    @else
                    <p class="text-center text-muted">No hay datos disponibles para el grupo y alumno seleccionados.</p>
                    @endif
                </div>
</div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</section>
@endsection