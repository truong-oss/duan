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
            <h1>Quản lý danh mục sản phẩm</h1>
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
                <a href="<?=BASE_URL_ADMIN . '?act=form-them-danh-muc'?>">
                  <button class="btn btn-success">Thêm danh mục</button>
                </a>
              </div>

            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Tên danh mục</th>
                    <th>Mô tả</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($listDanhMuc as $key =>$danhmuc): ?>
                    <tr>
                      <td><?=$key +1?></td>
                      <td><?=$danhmuc['ten_danh_muc']?></td>
                      <td><?=$danhmuc['mo_ta']?></td>
                      <td>
                        <a href="<?= BASE_URL_ADMIN . '?act=form-sua-danh-muc&id_danh_muc='. $danhmuc['id']?>">
                          <button class="btn btn-warning">Sửa</button>
                        </a>
                        <a href="<?= BASE_URL_ADMIN . '?act=xoa-danh-muc&id_danh_muc='.$danhmuc['id']?>" onclick="return confirm('Bạn chắc chắn muốn xóa chưa?')">
                          <button class="btn btn-danger">Xóa</button>
                        </a>
                      </td>
                    </tr>
                    <?php endforeach ?>
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
<!-- Page specific script -->
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
</body>

</html>