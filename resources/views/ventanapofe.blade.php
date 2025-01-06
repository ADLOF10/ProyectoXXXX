<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Dashboard &mdash; Profesor</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('baken/assets/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('baken/assets/modules/fontawesome/css/all.min.css') }}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('baken/assets/modules/jqvmap/dist/jqvmap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('baken/assets/modules/weather-icon/css/weather-icons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('baken/assets/modules/weather-icon/css/weather-icons-wind.min.css') }}">
  <link rel="stylesheet" href="{{ asset('baken/assets/modules/summernote/summernote-bs4.css') }}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('baken/assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('baken/assets/css/components.css') }}">
  
        <!-- Start GA -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-94034622-3');
        </script>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- /END GA -->
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1" >
      <div class="navbar-bg" style="background-color: #004d40;"></div>
      <!-- barra de busqueda  -->
      <nav class="navbar navbar-expand-lg main-navbar"  style="background-color: #004d40;">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Mensajes
                <div class="float-right">
                  <a href="#"></a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-message">
                
                
              </div>
              
            </div>
          </li>
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Notificaciones
                
              </div>
              <div class="dropdown-list-content dropdown-list-icons">
              
              </div>
              
            </div>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            
            <div class="d-sm-none d-lg-inline-block">{{Auth::user()->nombre;}}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">inicio seción  5 min </div>
              <a href="#" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Perfil
              </a>
              <a href="#" class="dropdown-item has-icon">
                <i class="fas fa-bolt"></i> Actividades
              </a>
              <a href="#" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> configuaracion
              </a>
              <div class="dropdown-divider"></div>
              <a href="{{ route('login') }}" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Cerrar Secion
              </a>
            </div>
          </li>
        </ul>
      </nav>
      
      <!-- barra lateral  -->
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a >Profesor</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a >P</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">"Biemvenido"</li>
            <li class="dropdown active">
              <a href="{{ route('dash.pofe') }}" class="nav-link ">Inicio</a>
            </li>
            <li class="dropdown active">
              <a href="#" class="nav-link has-dropdown">Menu</a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('crudalumno-profe') }}">Alumnos</a></li>
                <li class=active><a class="nav-link" href="{{ route('consultarGru') }}">Grupos</a></li>
                <li><a class="nav-link" href="{{ route('verGrupo') }}">Generar qr</a></li>
                <li><a class="nav-link" href="{{ route('asistencia-profe') }}">Asistencias</a></li>
              </ul>
            </li>
            <li class="menu-header">Aumentar beneficios</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Suscripciones</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="#">Plan</a></li>
              </ul>
            </li>
            <li><a class="nav-link" href="#"><i class="far fa-square"></i> <span>Blank Page</span></a></li>

            <a href="#" class="btn btn-primary btn-lg btn-block btn-icon-split" style="background-color: #004d40;">
              <i class="fas fa-rocket"></i> Documentation
            </a>
       </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">

        @yield('content')

      </div>
      <footer class="main-footer" style="background-color: #004d40;">
        <div class="footer-left">
          <a>© 2024 Universidad - Todos los derechos reservados</a>
        </div>
        <div class="footer-right">
          
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ asset('baken/assets/modules/jquery.min.js') }}"></script>
  <script src="{{ asset('baken/assets/modules/popper.js') }}"></script>
  <script src="{{ asset('baken/assets/modules/tooltip.js') }}"></script>
  <script src="{{ asset('baken/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('baken/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('baken/assets/modules/moment.min.js') }}"></script>
  <script src="{{ asset('baken/assets/js/stisla.js') }}"></script>
  
  <!-- JS Libraies -->
  <script src="{{ asset('baken/assets/modules/simple-weather/jquery.simpleWeather.min.js') }}"></script>
  <script src="{{ asset('baken/assets/modules/chart.min.js') }}"></script>
  <script src="{{ asset('baken/assets/modules/jqvmap/dist/jquery.vmap.min.js') }}"></script>
  <script src="{{ asset('baken/assets/modules/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
  <script src="{{ asset('baken/assets/modules/summernote/summernote-bs4.js') }}"></script>
  <script src="{{ asset('baken/assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

  <!-- Page Specific JS File -->
  <script src="{{ asset('baken/assets/js/page/index-0.js') }}"></script>
  
  <!-- Template JS File -->
  <script src="{{ asset('baken/assets/js/scripts.js') }}"></script>
  <script src="{{ asset('baken/assets/js/custom.js') }}"></script>
</body>
</html>