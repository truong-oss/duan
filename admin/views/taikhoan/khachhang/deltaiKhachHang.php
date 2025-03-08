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
          <h1>quản lí tài khoản khach hang</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <div class="container-fluid">
    <div class="row">
        <div class="col-md-4 text-center">
            <img src="<?= BASE_URL . $khachHang['anh_dai_dien'] ?>" style="width: 100%; height: auto;" alt="Avatar" 
                 onerror="this.onerror = null; this.src='https://static-00.iconduck.com/assets.00/user-icon-2046x2048-9pwm22pp.png'" 
                 class="img-thumbnail">
                 
        </div>
        <div class="col-md-8">  
            <div class="table-responsive"  style="width: 100%;">
                <table class="table table-borderless" >
                    <tbody style="font-size: large;">
                        <tr>
                            <th>Họ tên:</th>
                            <td><?= $khachHang['ho_ten'] ?? '' ?></td>
                        </tr>
                        <tr>
                            <th>Ngày sinh:</th>
                            <td><?= $khachHang['ngay_sinh'] ?? '' ?></td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td><?= $khachHang['email'] ?? '' ?></td>
                        </tr>
                        <tr>
                            <th>Số điện thoại:</th>
                            <td><?= $khachHang['so_dien_thoai'] ?? '' ?></td>
                        </tr>
                        <tr>
                            <th>Giới tính:</th>
                            <td><?= $khachHang['gioi_tinh'] == 1 ? 'Nam' : 'Nữ' ?></td>
                        </tr>
                        <tr>
                            <th>Địa chỉ:</th>
                            <td><?= $khachHang['dia_chi'] ?? '' ?></td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-12 mt-4">
        <hr>
        <h2>Lịch sử mua hàng</h2>
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã sản phẩm</th>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Ngày đặt</th>
                        <th>Tổng số tiền</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                  <?php foreach ($listDonHang as $key => $DonHang): ?>
                        <tr>
                                <td><?= $key + 1 ?></td>
                            <td><?= $DonHang['ma_don_hang'] ?></td>
                            <td><?= $DonHang['ten_nguoi_nhan'] ?></td>
                            <td><?= $DonHang['sdt_nguoi_nhan'] ?></td>
                            <td><?= date('d/m/Y', strtotime($DonHang['ngay_dat'])) ?></td>
                            <td><?= $DonHang['tong_tien'] ?></td>
                            <td><?= $DonHang['ten_trang_thai'] ?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?= BASE_URL_ADMIN . '?act=chi-tiet-don-hang&id_don_hang=' . $DonHang['id'] ?>">
                                        <button class="btn btn-primary">Chi tiết</button>
                                    </a>
                                    <a href="<?= BASE_URL_ADMIN . '?act=form-sua-don-hang&id_don_hang=' . $DonHang['id'] ?>">
                                        <button class="btn btn-warning">Sửa</button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

  
</div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- /.control-sidebar -->
</div>
<?php include './views/layout/footer.php'; ?>   