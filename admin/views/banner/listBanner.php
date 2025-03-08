<!-- header -->
<?php include './views/layout/header.php'; ?>
<!-- Navbar -->
<?php include './views/layout/navbar.php'; ?>

<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php include './views/layout/sidebar.php'; ?>


 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lý banner</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <a href="<?=BASE_URL_ADMIN . '?act=form-them-banner'?>">
                  <button class="btn btn-success">Thêm banner</button>
                </a>
              </div>

            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Tiêu đề</th>
                    <th>Ảnh</th>
                    <th>Ngày update</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($listBanner as $key=>$banner): ?>
                    <tr>
                      <td><?=$key +1?></td>
                      <td><?=$banner['mo_ta']?></td>
                      <td><img src="<?= BASE_URL . $banner['link_anh'] ?>" style="width:100px;height:100px" alt=""></td>
                      <td><?=$banner['ngay_dang']?></td>
                      <td><?=$banner['trang_thai_id']==1? 'ẩn':'bỏ ẩn'?></td>
                      <td>
                        <a href="<?= BASE_URL_ADMIN. '?act=form-edit-banner&id='. $banner['id']?>">
                          <button class="btn btn-warning">Sửa</button>
                        </a>
                       <form action="<?= BASE_URL_ADMIN . '?act=update-trang-thai&id_banner=' ?>" method="post">
                        <input type="hidden" name="id_banner" value="<?= $banner['id'] ?>">
                        <button class="btn btn-danger" onclick="return confirm('bạn có muốn ẩn banner này không?')"><?= $banner['trang_thai_id']==1?'ẩn':'bỏ ẩn' ?></button>
                       </form>
                        <a href="<?= BASE_URL_ADMIN. '?act=delete-banner&id='. $banner['id']?>" onclick="return confirm('Bạn chắc chắn muốn xóa chưa?')">
                          <button class="btn btn-danger">Xóa</button>
                        </a>
                      </td>
                    </tr>
                    <?php endforeach;?>
                    
                </tbody>
              </table>
            </div>

            </div>
          
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!-- footer -->

<?php include './views/layout/footer.php'; ?>
<!-- end footer -->