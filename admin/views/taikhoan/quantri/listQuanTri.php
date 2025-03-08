<?php require './views/layout/header.php'; ?>
<!-- Navbar -->
<?php include './views/layout/navbar.php'; ?>
<?php include './views/layout/sidebar.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>QUẢN LÝ TÀI KHOẢN QUẢN TRỊ</h1>
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

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">TÀI KHOẢN QUẢN TRỊ </h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>

          <i class="fas fa-times"></i>

        </div>
      </div>
      <div class="card-body p-0">
        <div class="card-header">
          <a href="<?= BASE_URL_ADMIN . '?act=form-them-quan-tri' ?>"><button class="btn btn-success">thêm tài khoản</button></a>
        </div>
        <table class="table table-striped projects">
          <thead>
            <tr>
              <th>
                STT
              </th>
              <th>
                HỌ VÀ TÊN
              </th>

              <th>
                EMAIL
              </th>
              <th>
                NGÀY SINH
              </th>
              <th>
                SỐ ĐIỆN THOAI
              </th>
              <th>
                giới tính
              </th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($listQuanTri as $key => $quantri) : ?>

              <tr>
                <td><?= $key + 1 ?></td>
                <td><?= $quantri['ho_ten'] ?></td>
                <td><?= $quantri['email'] ?></td>
                <td><?= $quantri['ngay_sinh'] ?></td>
                <td><?= $quantri['so_dien_thoai'] ?></td>
                <td><?= $quantri['gioi_tinh'] == 1 ? 'Nam' : 'Nữ' ?></td>
                <td>
                  <a href="<?= BASE_URL_ADMIN . '?act=delete-quan-tri&id_quan_tri=' . $quantri['id'] ?>"
                    class="btn btn-danger btn-sm" onclick="return confirm('Bạn chắc chắn muốn xóa tài khoản này?');">
                    <i class="fas fa-trash"></i> Xóa
                  </a>
                  <a class="btn btn-info btn-sm" href="<?= BASE_URL_ADMIN . '?act=form-sua-quan-tri&id_quan_tri=' .  $quantri['id'] ?>" style="float: left; margin-right: 10px;">
            <i class="fas fa-pencil-alt"></i> Edit
          </a>
                </td>
              </tr>

            <?php endforeach; ?>



          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include './views/layout/footer.php'; ?>