<?php include './views/layout/header-nav.php' ?>

  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .header-title {
      color: #ff6f61;
    }
    .pet-avatar {
      border: 4px solid #ff6f61;
    }
    .btn-pet {
      background-color: #ff6f61;
      color: white;
    }
    .btn-pet:hover {
      background-color: #ff4a36;
    }
  </style>
</head>
<body>
<div class="container my-5">
  <!-- Tiêu đề -->

  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-3 mb-4">
      <div class="list-group">
        <a style="background-color: #87CEFA; color:aliceblue    " href="#"  class="list-group-item  ">Thông tin tài khoản</a>
        <a href="<?= BASE_URL . '?act=form-doi-mk' ?>" class="list-group-item list-group-item-action">Đổi mật khẩu</a>
        <a href="<?= BASE_URL . '?act=don-hang' ?>" class="list-group-item list-group-item-action">Đơn hàng</a>
        <a href="<?= BASE_URL . '?act=logout-client' ?>" class="list-group-item list-group-item-action text-danger">Đăng xuất</a>
      </div>
    </div>

    <!-- Content -->
    <div class="col-md-9">
      <!-- Thông tin cá nhân -->
      <div class="card">
        <div style="background-color:#87CEFA; color:aliceblue " class="card-header   ">Thông Tin Cá Nhân</div>
        <div class="card-body">
          <form action="<?=BASE_URL . "?act=update-tai-khoan-client"?>" method="POST" enctype="multipart/form-data">
            <div class="row">
            <?php if(isset($chitiettaikhoan)): ?>
              <div class="row">
                <div class="col-md-4 text-center">
                  
                      <img class="rounded-circle img-thumbnail pet-avatar mb-3" style="width: 150px; height: 150px;" src="<?= $chitiettaikhoan['anh_dai_dien'] ?>"  alt=""
                          onerror="this.onerror=null;   this.src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTrCcjAUA-4_IjKjNpJpwKLuoXuMktjbhTA5g&s'">
                          <input type="file" name="anh_dai_dien">
          <!-- Trường ẩn lưu ảnh đại diện cũ -->
          <input type="hidden" name="anh_dai_dien_cu" value="<?= $chitiettaikhoan['anh_dai_dien'] ?>">
                </div>

                <div class="col-md-8">
                  <div class="mb-3">
                    <label for="ho_ten" class="form-label">Họ và Tên</label>
                    <input type="text" class="form-control" id="ho_ten" name="ho_ten" value="<?=$chitiettaikhoan['ho_ten']?>" >
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?=$chitiettaikhoan['email']?>" >
                  </div>
                  <div class="mb-3">
                    <label for="so_dien_thoai" class="form-label">Số Điện Thoại</label>
                    <input type="text" class="form-control" id="so_dien_thoai" name="so_dien_thoai" value="<?=$chitiettaikhoan['so_dien_thoai']?>" >
                  </div>
                  <!-- <div class="mb-3">
                    <label for="gioi_tinh" class="form-label">Giới tính</label>
                    <input type="text" class="form-control" id="gioi_tinh" name="gioi_tinh" value="<?=$chitiettaikhoan['gioi_tinh']?>" >
                  </div> -->
                  <div class="mb-3">
  <label for="gioi_tinh" class="form-label">Giới tính</label>
  <select class="form-control" id="gioi_tinh" name="gioi_tinh">
    <option value="Nam" <?= ($chitiettaikhoan['gioi_tinh'] == 'Nam') ? 'selected' : '' ?>>Nam</option>
    <option value="Nữ" <?= ($chitiettaikhoan['gioi_tinh'] == 'Nữ') ? 'selected' : '' ?>>Nữ</option>
    <option value="Khác" <?= ($chitiettaikhoan['gioi_tinh'] == 'Khác') ? 'selected' : '' ?>>Khác</option>
  </select>
</div>

                  <div class="mb-3">
                    <label for="dia_chi" class="form-label">Địa Chỉ</label>
                    <input type="text" class="form-control" id="dia_chi" name="dia_chi" value="<?=$chitiettaikhoan['dia_chi']?>" >
                  </div>
                  <button type="submit" class="btn btn-pet">Cập nhật thông tin</button>
                </div>
              </div>
              <?php else: ?>
                <p class="text-danger">Không tìm thấy thông tin khách hàng.</p>
                <?php endif ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php include './views/layout/footer.php' ?>
