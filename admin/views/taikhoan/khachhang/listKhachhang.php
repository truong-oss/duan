<?php require './views/layout/header.php'; ?>
<!-- Navbar -->
<?php include './views/layout/navbar.php'; ?>
<?php include './views/layout/sidebar.php'; ?>
<style>
  td a {
    display: inline-block;
    /* Đảm bảo các nút nằm trên cùng một dòng */
    margin-right: 5px;
    /* Thêm khoảng cách giữa các nút */
  }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>tài khoản khách hàng</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Projects</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">

            <!-- /.card -->

            <div class="card">

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <thead>
                      <tr>
                        <th>
                          STT
                        </th>
                        <th>
                          HỌ VÀ TÊN
                        </th>
                        <th>
                          ẢNH ĐẠI ĐIỆN
                        </th>
                        <th>
                          EMAIL
                        </th>
                        <th>
                          SỐ ĐIỆN THOAI
                        </th>
                        
                        <th>
                          ĐỊA CHỈ
                        </th>
                        <th>
                          GIỚI TÍNH
                        </th>
                        <th>
                        TRẠNG THÁI
                      </th> 
                        <th>
                          CHỈNH SỬA
                        </th>
                      </tr>
                    </thead>
                  <tbody>
                    <?php
                    foreach ($listKhachHang as $key => $khachHang) : ?>
<tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $khachHang['ho_ten'] ?></td>
                        <td><img src="<?= BASE_URL . $khachHang['anh_dai_dien'] ?>" style="width:100px;" alt="" onerror="this.onerror = null; this.src='https://doanhnhanphaply.com/wp-content/uploads/2024/09/anh-meo-vo-tri-8.jpg'"></td>
                        <td><?= $khachHang['email'] ?></td>
                        <td><?= $khachHang['so_dien_thoai'] ?></td>
                        <td><?= $khachHang['dia_chi'] ?></td>
                        <td><?= $khachHang['gioi_tinh'] == 1 ? 'Nam' : 'Nữ' ?></td>
                        <td><?= $khachHang['trang_thai'] == 1 ? 'hoạt động' : 'Không hoạt động' ?></td>
                    
                        <td style="white-space: nowrap;">
                          <a class="btn btn-primary btn-sm" href="<?= BASE_URL_ADMIN . '?act=chi-tiet-khach-hang&id_khach_hang=' . $khachHang['id'] ?>" style="float: left; margin-right: 10px;">
                            <i class="fas fa-folder"></i> View
                          </a>
                          <a class="btn btn-info btn-sm" href="<?= BASE_URL_ADMIN . '?act=form-sua-khach-hang&id_khach_hang=' . $khachHang['id'] ?>" style="float: left; margin-right: 10px;">
                            <i class="fas fa-pencil-alt"></i> Edit
                          </a>
                          <a href="<?= BASE_URL_ADMIN . '?act=delete-khach-hang&id_khach_hang=' . $khachHang['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn chắc chắn muốn xóa tài khoản này?');" style="float: left;">
                            <i class="fas fa-trash"></i> Xóa
                          </a>
                        </td>

                      </tr> 

                    <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>
                        STT
                      </th>
                      <th>
                        HỌ VÀ TÊN
                      </th>
                      <th>
                        ẢNH ĐẠI ĐIỆN
                      </th>
                      <th>
                        EMAIL
                      </th>
                     
                      <th>
                        SỐ ĐIỆN THOAI
                      </th>
                     
                      <th>
                          ĐỊA CHỈ
                        </th>
                        <th>
                        GIỚI TÍNH
                      </th>
                      <th>
                        TRẠNG THÁI
                      </th>
                      <th>
                        CHỈNH SỬA
                      </th>
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
  <!-- Main content -->

  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include './views/layout/footer.php'; ?>