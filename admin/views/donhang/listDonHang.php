<?php require_once 'views/layout/navbar.php' ?>
<?php require_once 'views/layout/header.php' ?>
<!-- Content Wrapper. Contains page content -->


<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Thông tin đơn hàng</h1>
        </div>

      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->


  <div class="card">

    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Mã đơn hàng</th>
            <th>Tên người nhận</th>
            <th>Số điện thoại</th>
            <th>Ngày đặt</th>
            <th>Tổng tiền</th>
            <th>Trạng thái thanh toán</th>
            <th>Trạng thái đơn hàng</th>
            <th>Thao tác</th>
          </tr>
        </thead>
        <tbody>
        <?php
            // Sắp xếp đơn hàng theo ngày đặt giảm dần (mới nhất lên đầu)
            usort($listdonhang, function ($a, $b) {
                return strtotime($b['ngay_dat']) - strtotime($a['ngay_dat']);
            });
          ?>
          <?php foreach ($listdonhang as $key => $donHang): ?>
  

            <tr>
              <td><?= $donHang['ma_don_hang'] ?></td>
              <td><?= $donHang['ten_nguoi_nhan'] ?></td>
              <td><?= $donHang['sdt_nguoi_nhan'] ?></td>
              <td><?= $donHang['ngay_dat'] ?></td>
              <td><?= $donHang['tong_tien'] ?></td>
              <td><?= $donHang['ten_trang_thais'] ?></td>
              <td><?= $donHang['ten_trang_thai'] ?></td>
              <td>
                <a href="<?= BASE_URL_ADMIN . '?act=chi-tiet-don-hang&id_don_hang=' . $donHang['id'] ?>">
                  <button class="btn btn-primary">chi tiết</button></a>
                <a href="<?= BASE_URL_ADMIN . '?act=form-sua-don-hang&id_don_hang=' . $donHang['id'] ?>">
                  <button class="btn btn-warning">sửa</button>
                </a>
              </td>
            </tr>
          <?php endforeach; ?>

        </tbody>
        <tfoot>
          <tr>
            <th>Mã đơn hàng</th>
            <th>Tên người nhận</th>
            <th>Số điện thoại</th>
            <th>Ngày đặt</th>
            <th>Tổng tiền</th>
            <th>Trạng thái thanh toán</th>
            <th>Trạng thái đơn hàng</th>
            <th>Thao tác</th>

          </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
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
<?php require_once 'views/layout/footer.php' ?>
<?php require_once 'views/layout/sidebar.php' ?>