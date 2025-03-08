<?php require './views/layout/header.php'; ?>
<!-- Navbar -->
<?php include './views/layout/navbar.php'; ?>
<?php include './views/layout/sidebar.php'; ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>quản lí tài khoản quản trị viên</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">thêm tài khoản quản trị</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= BASE_URL_ADMIN .'?act=them-quan-tri' ?>" method="post">
  <div class="card-body">
    <div class="form-group col-12">
      <label for="ho_ten">Họ tên</label>
      <input type="text" class="form-control" name="ho_ten" id="ho_ten" placeholder="Nhập họ tên" required>
      <?php if(isset($_SESSION['error']['ho_ten'])){ ?>
        <p class="text-danger"><?=$_SESSION['error']['ho_ten'] ?></p>
      <?php } ?>
    </div>
    
    <div class="form-group col-12">
      <label for="email">Email</label>
      <input type="email" class="form-control" name="email" id="email" placeholder="Nhập email" required>
      <?php if(isset($_SESSION['error']['email'])){ ?>
        <p class="text-danger"><?=$_SESSION['error']['email'] ?></p>
      <?php } ?>
    </div>
    
    <div class="form-group col-12">
      <label for="so_dien_thoai">Số điện thoại</label>
      <input type="tel" class="form-control" name="so_dien_thoai" id="so_dien_thoai" placeholder="Nhập số điện thoại" required>
      <?php if(isset($_SESSION['error']['so_dien_thoai'])){ ?>
        <p class="text-danger"><?=$_SESSION['error']['so_dien_thoai'] ?></p>
      <?php } ?>
    </div>
    
    <div class="form-group col-12">
      <label for="ngay_sinh">Ngày sinh</label>
      <input type="date" class="form-control" name="ngay_sinh" id="ngay_sinh" required>
      <?php if(isset($_SESSION['error']['ngay_sinh'])){ ?>
        <p class="text-danger"><?=$_SESSION['error']['ngay_sinh'] ?></p>
      <?php } ?>
    </div>
    
    <div class="form-group col-12">
      <label for="gioi_tinh">Giới tính</label>
      <select id="gioi_tinh" name="gioi_tinh" class="form-control custom-select" required>
        <option value="1" <?= isset($_SESSION['error']['gioi_tinh']) && $_SESSION['error']['gioi_tinh'] == 1 ? 'selected' : '' ?>>Nam</option>
        <option value="2" <?= isset($_SESSION['error']['gioi_tinh']) && $_SESSION['error']['gioi_tinh'] == 2 ? 'selected' : '' ?>>Nữ</option>
      </select>
      <?php if(isset($_SESSION['error']['gioi_tinh'])){ ?>
        <p class="text-danger"><?=$_SESSION['error']['gioi_tinh'] ?></p>
      <?php } ?>
    </div>
  </div>

  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>

             
        
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>



<?php include './views/layout/footer.php'; ?>