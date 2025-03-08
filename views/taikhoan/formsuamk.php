<?php include './views/layout/header-nav.php' ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <!-- thông báo  -->
    <?php if (isset($_SESSION['error'])): ?>
  <div class="alert alert-danger">
    <?php foreach ($_SESSION['error'] as $error): ?>
      <p><?= $error ?></p>
    <?php endforeach; ?>
  </div>
  <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['success'])): ?>
  <div class="alert alert-success">
    <?= $_SESSION['success'] ?>
  </div>
  <?php unset($_SESSION['success']); ?>
<?php endif; ?>


  <!-- Dòng chứa Sidebar và Form đổi mật khẩu -->
  <div class="row g-4">
    <!-- Sidebar -->
    <div class="col-md-4">
      <div class="list-group">
      <a href="<?= BASE_URL . '?act=chi-tiet-tai-khoan' ?>" style="background-color: #87CEFA; color:aliceblue    " href="#"  class="list-group-item  ">Thông tin tài khoản</a>

        <a href="#" class="list-group-item list-group-item-action">Đổi mật khẩu</a>
        <a href="<?= BASE_URL . '?act=don-hang' ?>" class="list-group-item list-group-item-action">Đơn hàng</a>

        <a href="<?= BASE_URL . '?act=logout-client' ?>" class="list-group-item list-group-item-action text-danger">Đăng xuất</a>
      </div>
    </div>
    <!-- Form đổi mật khẩu -->
    <div class="col-md-8">
      <div class="card">
        <div class="card-header bg-primary text-white">Đổi Mật Khẩu</div>
        <div class="card-body">
          <form action="<?= BASE_URL . "?act=doi-mat-khau" ?>" method="POST">
            <div class="mb-3">
              <label for="old_password" class="form-label">Mật khẩu cũ</label>
              <input type="password" class="form-control" id="old_password" name="mat_khau_cu" required>
            </div>
            <div class="mb-3">
              <label for="new_password" class="form-label">Mật khẩu mới</label>
              <input type="password" class="form-control" id="new_password" name="mat_khau_moi" required>
            </div>
            <div class="mb-3">
              <label for="confirm_password" class="form-label">Xác nhận mật khẩu mới</label>
              <input type="password" class="form-control" id="confirm_password" name="mat_khau_mois" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Đổi mật khẩu</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php include './views/layout/footer.php' ?>
