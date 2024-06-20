<!-- resources/views/layouts/partials/_header.blade.php -->

<!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
  </div>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="height:100px">
    
   <ul class="navbar-nav" style="height:100px">
     
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('stateData')}}" class="nav-link">
            <img class="animation__shake" src="{{asset('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
            <p style="color: #0299b8;font-weight: bold;font-size: 15px;">HARBAUER (INDIA) PRIVATE LIMITED 
            </p>

        </a>
      </li>
      
     
    </ul>


    <!-- resources/views/layouts/partials/_top_bar_right.blade.php -->
<ul class="navbar-nav ml-auto" style="height:100px">
 
      <li class="nav-item">
        <div style="float:right">
            <img class="animation__shake" src="{{asset('adminlte/dist/img/logoHar.jpeg')}}" alt="AdminLTELogo" height="70" width="70" style="    margin-left: 75%;"/>
            <p style="color: #0299b8;font-weight: bold;font-size: 15px;">PUBLIC HEALTH ENGINEERING DEPARTMENT, GOVT. OF BIHAR 

        </p>
        
        </div>


    
    </li>
</ul>
    
</nav>
  <!-- /.navbar -->
