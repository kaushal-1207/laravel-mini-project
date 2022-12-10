  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      @if(session('user'))
      <li class="nav-item dropdown">
        <a class="nav-link" href="logout">
          <i class="far fa-user"> Logout</i>
        </a>
      </li>
      @else
      <li class="nav-item dropdown">
        <a class="nav-link" href="login">
          <i class="far fa-user"> Login</i>
        </a>
      </li>
      @endif
    </ul>
  </nav>
  <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <center class="brand-link">
      <span class="brand-text font-weight-light">Admin Panel</span>
    </center>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          {{-- <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> --}}
          <i class="fa fa-user" style="font-size:25px;padding-top: 5px;"></i>
        </div>
        @if(session('user'))
        <div class="info">
          <a href="" class="d-block">Hello, {{session('user')['username']}}</a>
        </div>
        @endif
      </div>
      <!-- Sidebar Menu -->
<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="dashboard" class="nav-link {{ Request::path() == 'admin/dashboard' ? 'active' : '' }}">
              
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @if(session('user')['role'] == 'admin')
          <li class="nav-item">
            <a href="add_products" class="nav-link {{ Request::path() == 'admin/add_products' ? 'active' : '' }}">
              
              <p>
                Add Products
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="view_products" class="nav-link {{ Request::path() == 'admin/view_products' ? 'active' : '' }}">
              
              <p>
                View Products
              </p>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a href="add_customers" class="nav-link {{ Request::path() == 'admin/add_customers' ? 'active' : '' }}">
              
              <p>
                Add Customers
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="view_customers" class="nav-link {{ Request::path() == 'admin/view_customers' ? 'active' : '' }}">
              
              <p>
                View Customers
              </p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
    <!-- /.sidebar -->
  </aside>
