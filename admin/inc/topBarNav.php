<style>
  body {
    background-color: black;
    color: #ffffff;
  }

  .navbar {
    background-color: black;
    color: white;
  }

  .nav-link,
  .dropdown-item {
    color: #ffffff;
  }

  .nav-link:hover,
  .dropdown-item:hover {
    background-color: #14453d;
    color: #ffffff;
  }

  .user-img {
    position: absolute;
    height: 27px;
    width: 27px;
    object-fit: cover;
    left: -7%;
    top: -12%;
  }

  .btn-rounded {
    border-radius: 50px;
    background-color: #14453d;
    color: #ffffff;
  }


  .dropdown-menu {
    background-color: #1e1e1e;
  }

  .dropdown-item {
    color: #ffffff;
  }

  .dropdown-item:hover {
    background-color: #14453d;
  }
</style>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-light text-sm shadow">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="<?php echo base_url ?>" class="nav-link text-white"><?php echo (!isMobileDevice()) ? $_settings->info('name') : $_settings->info('short_name'); ?></a>
    </li>
  </ul>
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Messages Dropdown Menu -->
    <li class="nav-item">
      <div class="btn-group nav-link">
        <button type="button" class="btn btn-rounded badge badge-light dropdown-toggle dropdown-icon" data-toggle="dropdown">
          <span><img src="<?php echo validate_image($_settings->userdata('avatar')) ?>" class="img-circle elevation-2 user-img" alt="User Image"></span>
          <span class="ml-3"><?php echo ucwords($_settings->userdata('firstname') . ' ' . $_settings->userdata('lastname')) ?></span>
          <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu" role="menu">
          <a class="dropdown-item" href="<?php echo base_url . 'admin/?page=user' ?>"><span class="fa fa-user"></span> My Account</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?php echo base_url . '/classes/Login.php?f=logout' ?>"><span class="fas fa-sign-out-alt"></span> Logout</a>
        </div>
      </div>
    </li>
  </ul>
</nav>
<!-- /.navbar -->