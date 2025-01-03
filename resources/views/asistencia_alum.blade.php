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

        
    <div class="container mt-5">
      <h1 class="text-center">Gráfica de Asistencias</h1>
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-body">
                      <canvas id="attendanceChart" width="400" height="200"></canvas>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <script>
      // Pasar datos desde Laravel a JavaScript
      const chartData = @json($data);
      const labels = Object.keys(chartData); // Usuarios (IDs o nombres)
      const attendanceData = labels.map(user => chartData[user].asistencias);
      const tardinessData = labels.map(user => chartData[user].retardos);
      const absenceData = labels.map(user => chartData[user].faltas);

      // Crear la gráfica con Chart.js
      const ctx = document.getElementById('attendanceChart').getContext('2d');
      new Chart(ctx, {
          type: 'bar',
          data: {
              labels: labels, // Nombres o IDs de usuarios
              datasets: [
                  {
                      label: 'Asistencias (%)',
                      data: attendanceData,
                      backgroundColor: 'rgba(75, 192, 192, 0.6)',
                  },
                  {
                      label: 'Retardos (%)',
                      data: tardinessData,
                      backgroundColor: 'rgba(255, 206, 86, 0.6)',
                  },
                  {
                      label: 'Faltas (%)',
                      data: absenceData,
                      backgroundColor: 'rgba(255, 99, 132, 0.6)',
                  },
              ],
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

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
              



      </div>

    
        
     
  </section>
  @endsection