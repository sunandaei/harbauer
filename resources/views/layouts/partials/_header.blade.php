<!-- resources/views/layouts/partials/_header.blade.php -->

<!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
  </div>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    
    <!-- Left navbar links -->
    @include('layouts.partials._top_bar_left')
    <!-- Right navbar links -->
    @include('layouts.partials._top_bar_right')
    
    
  </nav>
  <!-- /.navbar -->
