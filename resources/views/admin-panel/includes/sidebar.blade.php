
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('admin-dashboard')}}" class="brand-link">
      <img src="{{asset('backend/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Dashboard</span>
    </a><!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Dashboard -->
        <li class="nav-item">
            <a href="{{ url('admin-dashboard') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <!-- Users List -->
        <li class="nav-item">
            <a href="{{ url('admin-user-list') }}" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>Users List</p>
            </a>
        </li>
        <!-- Novel List -->
        <li class="nav-item">
            <a href="{{ url('admin-novel-list') }}" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>Novel List</p>
            </a>
        </li>
        <!-- Logout -->
        <li class="nav-item">
            <a href="{{ url('admin-logout') }}" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Logout</p>
            </a>
        </li>
    </ul>
</nav>

      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>