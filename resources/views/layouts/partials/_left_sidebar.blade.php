<!-- resources/views/layouts/partials/_left_sidebar.blade.php -->

 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{route('stateData')}}" class="d-block">Harbauer India</a>

          @if (Auth::check())
           
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
           
        @endif
      
        </div>
      </div>

      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{ route('stateData') }}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                State summary
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            

          </li>


          <li class="nav-item menu-open">
            <a href="{{ route('Result') }}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Result
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            

          </li>
          @if (Auth::check() && Auth::user()->email !== 'client@gmail.com')
           <li class="nav-item menu-open">
            <a href="{{ route('uploadForm') }}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Upload Results
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            

          </li> 
          @endif
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Report
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('analyticalSchemeData') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Analytical Scheme</p>
                </a>
              </li>
              
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('analyticalDataMonthly') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Monthly Analytical Data</p>
                </a>
              </li>
              
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('deviceAnalyticalDataMonthly') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Device Analytical Data</p>
                </a>
              </li>
              
            </ul>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>