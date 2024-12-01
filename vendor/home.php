<h1 class="text-center text-light">Welcome to <?php echo $_settings->info('name') ?> - Vendor Side</h1>
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
    border-radius: 10px;
  }

  .info-box {
    background-color: #1e1e1e;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
  }

  .info-box-icon {
    background-color: #14453d;
    border-radius: 50%;
    padding: 20px;
  }

  .info-box-text {
    font-size: 1.2em;
    font-weight: bold;
  }

  .info-box-number {
    font-size: 1.5em;
  }

  .clear-fix {
    margin-top: 20px;
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
        <span class="info-box-number text-left h4">
          <?php
          $total = $conn->query("SELECT count(id) as total FROM category_list where delete_flag = 0 and vendor_id = '{$_settings->userdata('id')}' ")->fetch_assoc()['total'];
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
        <span class="info-box-number text-left h4">
          <?php
          $total = $conn->query("SELECT count(id) as total FROM product_list where delete_flag = 0 and  vendor_id = '{$_settings->userdata('id')}' ")->fetch_assoc()['total'];
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
        <span class="info-box-number text-left h4">
          <?php
          $total = $conn->query("SELECT count(id) as total FROM order_list where `status` = 0 and  vendor_id = '{$_settings->userdata('id')}' ")->fetch_assoc()['total'];
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