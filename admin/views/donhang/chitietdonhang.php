<?php require_once 'views/layout/navbar.php' ?>
<?php require_once 'views/layout/header.php' ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <style>
  
  </style>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Chi tiết đơn hàng: <?= $donHang['ma_don_hang'] ?></h1>
        
        </div>
        <div class="col-sm-6">

        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">


          <!-- Main content -->
          <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
              <div class="col-12">
                <h4>
                  <small class="float-right">ngày đặt:<?= $donHang['ngay_dat'] ?></small>
                </h4>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
             

              <div class="col-sm-4 invoice-col">
                <b>Thông tin người nhận</b><br>
                tên người nhận: <?= $donHang['ten_nguoi_nhan'] ?><br>
                Số điện thoại: <?= $donHang['sdt_nguoi_nhan'] ?><br>
                Địa chỉ:  <?= $donHang['dia_chi_nguoi_nhan'] ?>
              </div>
              <div class="col-sm-4 invoice-col">
               <b> Trạng thái</b><br> 
               Phương thức thanh toán:</b> <?= $donHang['ten_hinh_thuc'] ?><br>
                trạng thái đơn hàng</b> <?= $donHang['ten_trang_thai'] ?><br>
                Trạng thái thanh toán:</b> <?= $donHang['ten_trang_thais'] ?><br>
               
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
  <div class="col-12 table-responsive">
    <table class="table custom-table w-100">
      <thead>
        <tr style="background-color:#444546; color: white;">
          <th>STT</th>
          <th>Tên sản phẩm</th>
          <th>Số lượng</th>
          <th>Mô tả</th>
          <th>Đơn giá</th>
        </tr>
      </thead>
      <tbody>
        <?php $tongtien = 0; ?>
        <?php foreach ($sanPhamDonHang as $key => $spdonhang): ?>
          <tr>
            <td><?= $key + 1 ?></td>
            <td><?= $spdonhang['ten_san_pham'] ?></td>
            <td><?= $spdonhang['so_luong'] ?></td>
            <td><?= $spdonhang['mo_ta'] ?></td>
            <td><?= number_format($spdonhang['thanh_tien'], 0, ',', '.') ?> VND</td>
            <?php
              if (isset($spdonhang['thanh_tien'])) {
                $tongtien += $spdonhang['thanh_tien'];
              }
            ?>
          </tr>
        <?php endforeach; ?>
        <tr>
          <td colspan="4"><strong>Tổng cộng:</strong></td>
          <td><strong><?= number_format($tongtien, 0, ',', '.') ?> VND</strong></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
            <!-- /.row -->
            <div class="row">
              <!-- accepted payments column -->
              <div class="col-6">

              </div>
              <!-- /.col -->
              <div class="col-6">
                <div class="table-responsive">
                  <table class="table">
                    <tr>
                      <th style="width:63%">Tổng hàng:</th>
                      <td style="color: red;"><?= number_format($tongtien, 0, ',', '.') ?>VND</td>
                    </tr>


                    <tr>
                      <th>Shipping:</th>
                      <td style="color: red;">20.000VND</td>
                    </tr>
                    <tr>
                      <th>Tổng cộng:</th>
                      <td style="color: red;"> <?= number_format($tongtien + 20000, 0, ',', '.') ?>VND</td>
                    </tr>
                  </table>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<?php require_once 'views/layout/footer.php' ?>
<?php require_once 'views/layout/sidebar.php' ?>