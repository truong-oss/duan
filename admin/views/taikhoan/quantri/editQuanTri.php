<?php require './views/layout/header.php'; ?>
<!-- Navbar -->
<?php include './views/layout/navbar.php'; ?>
<?php include './views/layout/sidebar.php'; ?>




  <!-- Main content -->
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
                <h3 class="card-title">sửa thông tin tài khoản quản trị: <?= $quantri['ho_ten']?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= BASE_URL_ADMIN . '?act=sua-quan-tri' ?>" method="post">
                <input type="hidden" name="khach_hang_id" value="<?=$quantri['id']; ?>">
              <div class="card-body">
                <div class="form-group col-12">
                    <label for="">họ tên</label>
                    <input type="text" class="form-control" name="ho_ten" value="<?=$quantri['ho_ten']; ?>" placeholder="nhập họ tên">
                    <?php if(isset($_SESSION['error']['ho_ten'])){ ?>
                      <p class="text-danger"><?=$_SESSION['error']['ho_ten'] ?></p>
                  <?php  } ?>
                  </div>

                  <div class="form-group col-12">
                    <label for="">email</label>
                    <input type="email" class="form-control" name="email" value="<?=$quantri['email']; ?>" placeholder="nhập email">
                    <?php if(isset($_SESSION['error']['email'])){ ?>
                      <p class="text-danger"><?=$_SESSION['error']['email'] ?></p>
                  <?php  } ?>
                  </div>
                  <div class="form-group col-12">
                    <label for="">so dien thoai</label>
                    <input type="text" class="form-control" name="so_dien_thoai" value="<?=$quantri['so_dien_thoai']; ?>" placeholder="nhập so dien thoai">
                    <?php if(isset($_SESSION['error']['so_dien_thoai'])){ ?>
                      <p class="text-danger"><?=$_SESSION['error']['so_dien_thoai'] ?></p>
                  <?php  } ?>
                  </div>
                  <div class="form-group col-12">
                    <label for="">ngày sinh</label>
                    <input type="date" class="form-control" name="ngay_sinh" value="<?=$quantri['ngay_sinh']; ?>" placeholder="nhập số điện thoại">
                    <?php if(isset($_SESSION['error']['ngay_sinh'])){ ?>
                      <p class="text-danger"><?=$_SESSION['error']['ngay_sinh'] ?></p>
                  <?php  } ?>
                  </div>
                  <div class="form-group col-12">
                    <label for="">giớ tính  </label>
                    <select id="gioi_tinh" name="gioi_tinh" class="form-control custom-select">
                    <option <?= $quantri['gioi_tinh'] ==1 ? 'selected': '' ?> value="1">nam</option>
                    <option <?= $quantri['gioi_tinh'] ==2 ? 'selected': '' ?> value="2">nữ</option>
                  </select>
                  </div>
                  <div class="form-group col-12">
                    <label for="">địa chỉ</label>
                    <input type="text" class="form-control" name="dia_chi" value="<?=$quantri['dia_chi']; ?>" placeholder="nhập số điện thoại">
                    <?php if(isset($_SESSION['error']['dia_chi'])){ ?>
                      <p class="text-danger"><?=$_SESSION['error']['dia_chi'] ?></p>
                  <?php  } ?>
                  </div>
                  <div class="form-group">
                  <label for="trang_thai">trạng thái tài khoản</label>
                  <select id="trang_thai" name="trang_thai" class="form-control custom-select">
                    <option <?= $quantri['trang_thai'] ==1 ? 'selected': '' ?> value="1">Active</option>
                    <option <?= $quantri['trang_thai'] !==1 ? 'selected': '' ?> value="2">Inactive</option>
                  </select>
                </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
        
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

<?php include './views/layout/footer.php'; ?>