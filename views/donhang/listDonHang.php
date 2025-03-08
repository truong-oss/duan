<?php include './views/layout/header-nav.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row justify-content-center align-items-center">
        <div class="col-sm-6 text-center">
          <h1>Thông tin đơn hàng đã đặt</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
            <?php
            // Sắp xếp theo thời gian đặt giảm dần
            usort($listdonhang, function($a, $b) {
              return strtotime($b['id']) <=> strtotime($a['id']); // Sắp xếp giảm dần
            });
            ?>
              <table class="table">
                <thead>
                  <tr>
                    <th>Mã đơn hàng</th>
                    <th>Tên người nhận</th>
                    <th>Mô Tả</th>
                    <th>Tổng Tiền</th>
                    <th>Thao Tác</th>
                  </tr>
                </thead>
                <tbody>
                <?php if (!empty($listdonhang)): ?>
                    <?php foreach ($listdonhang as $donHang): ?>
                      <tr>
                        <td><?= $donHang['ma_don_hang'] ?></td>
                        <td><?= $donHang['ten_nguoi_nhan'] ?></td>
                        <td><?= $donHang['ghi_chu'] ?></td>
                        <td><?= $donHang['tong_tien'] ?></td>
                        <td>
                          <form action="<?= BASE_URL . '?act=chi-tiet-don-hang&id_don_hang=' . $donHang['id'] ?>" method="post">
                            <button class="btn btn-primary">chi tiết</button>
                          </form>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                      <td colspan="5" class="text-center">Không có đơn hàng nào.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
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
<?php include './views/layout/footer.php'; ?>