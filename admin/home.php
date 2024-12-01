<h1 class="text-center text-light">Welcome to <?php echo $_settings->info('name') ?> - Admin Side</h1>
<style>
  body {
    background-color: #121212;
    color: #ffffff;
  }

  #cover-image {
    width: 100%;
    height: 50vh;
    object-fit: cover;
    object-position: center center;
  }

  .info-box {
    background-color: #1e1e1e;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
  }

  .info-box-icon {
    background-color: #14453d !important;
    border-radius: 50%;
    padding: 15px;
  }

  .info-box-text,
  .info-box-number {
    color: #ffffff;
  }

  .info-box-number {
    font-size: 1.5rem;
  }

  .clear-fix {
    margin-bottom: 20px;
  }

  .text-center {
    text-align: center;
  }

  .w-100 {
    width: 100%;
  }

  a,
  button {
    color: #14453d;
  }
</style>
<hr>
<div class="row">
  <div class="col-12 col-sm-4 col-md-4">
    <div class="info-box">
      <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-th-list"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Total Categories</span>
        <span class="info-box-number text-right h4">
          <?php
          $total = $conn->query("SELECT count(id) as total FROM category_list where delete_flag = 0 ")->fetch_assoc()['total'];
          echo format_num($total);
          ?>
        </span>
      </div>
    </div>
  </div>
  <div class="col-12 col-sm-4 col-md-4">
    <div class="info-box">
      <span class="info-box-icon bg-gradient-dark elevation-1"><i class="fas fa-th-list"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Total Shop Type</span>
        <span class="info-box-number text-right h4">
          <?php
          $total = $conn->query("SELECT count(id) as total FROM shop_type_list where delete_flag = 0 ")->fetch_assoc()['total'];
          echo format_num($total);
          ?>
        </span>
      </div>
    </div>
  </div>
  <div class="col-12 col-sm-4 col-md-4">
    <div class="info-box">
      <span class="info-box-icon bg-gradient-secondary elevation-1"><i class="fas fa-boxes"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Total Products</span>
        <span class="info-box-number text-right h4">
          <?php
          $total = $conn->query("SELECT count(id) as total FROM product_list where delete_flag = 0 ")->fetch_assoc()['total'];
          echo format_num($total);
          ?>
        </span>
      </div>
    </div>
  </div>
  <div class="col-12 col-sm-4 col-md-4">
    <div class="info-box">
      <span class="info-box-icon bg-gradient-light border elevation-1"><i class="fas fa-users"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Vendors</span>
        <span class="info-box-number text-right h4">
          <?php
          $total = $conn->query("SELECT count(id) as total FROM vendor_list where delete_flag = 0 ")->fetch_assoc()['total'];
          echo format_num($total);
          ?>
        </span>
      </div>
    </div>
  </div>
  <div class="col-12 col-sm-4 col-md-4">
    <div class="info-box">
      <span class="info-box-icon bg-gradient-maroon elevation-1"><i class="fas fa-user-friends"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Clients</span>
        <span class="info-box-number text-right h4">
          <?php
          $total = $conn->query("SELECT count(id) as total FROM client_list where delete_flag = 0 ")->fetch_assoc()['total'];
          echo format_num($total);
          ?>
        </span>
      </div>
    </div>
  </div>
  <div class="col-12 col-sm-4 col-md-4">
    <div class="info-box">
      <span class="info-box-icon bg-gradient-warning elevation-1"><i class="fas fa-list"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Total Pending Orders</span>
        <span class="info-box-number text-right h4">
          <?php
          $total = $conn->query("SELECT count(id) as total FROM order_list where `status` = 0 ")->fetch_assoc()['total'];
          echo format_num($total);
          ?>
        </span>
      </div>
    </div>
  </div>
</div>

<div class="clear-fix mb-2">
  <div class="text-center w-100">
    <img src="<?= validate_image($_settings->info('cover')) ?>" alt="System Cover image" class="w-100" id="cover-image">
  </div>
</div>