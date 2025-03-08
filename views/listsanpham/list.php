<?php include './views/layout/header-nav.php'; ?>

<div class="bg-light py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-0">
        <a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> 
        <strong class="text-black">Shop</strong>
      </div>
    </div>
  </div>
</div>

<div class="site-section">
  <div class="container">
    <div class="row mb-5">
      <!-- Main Content Area -->
      <div class="col-md-9 order-2">
        <!-- Shop Header -->
        <div class="row mb-5">
          <div class="col-md-12">
            <div class="float-md-left mb-4">
              <h2 class="text-black h5">Shop All</h2>
            </div>
            <div class="d-flex">
            <div class="dropdown mr-1 ml-md-auto">
                <form action="<?=BASE_URL. '?act=loc-san-pham' ?> " method="POST" class="mb-6 ml-4 d-flex">
                  <select name="danh_muc" id="danh_muc" class="form-control mb-6">
                    <option value="">Tất cả</option>
                    <?php foreach ($listDanhmuc as $danhmuc): ?>
                      <option value="<?= $danhmuc['id'] ?>"><?= $danhmuc['ten_danh_muc'] ?></option>
                    <?php endforeach; ?>
                  </select>
                  <button type="submit" class="btn btn-primary">Lọc</button>
                </form>


              </div>
              
              
            </div>
          </div>
        </div>

        <!-- Product List -->
        <div class="row mb-5">
          <?php foreach ($listSanPham as $sanPham): ?>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="block-4 text-center">
              <figure class="block-4-image position-relative">
                <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>">
                  <img class="img-fluid" src="<?= BASE_URL . $sanPham['hinh_anh']; ?>" alt="Product">
                  <?php
                  $ngayNhap = new DateTime($sanPham['ngay_nhap']);
                  $ngayHienTai = new DateTime();
                  $tinhNgay = $ngayHienTai->diff($ngayNhap);

                  if ($tinhNgay->days <= 7): ?>
                    <span class="badge bg-danger text-white position-absolute top-0 start-0 m-2 " style="left: 0;">New</span>
                  <?php elseif ($sanPham['gia_khuyen_mai']): ?>
                    <span class="badge bg-success text-white position-absolute top-0 start-0 m-2 " style="left: 0;">Giảm giá</span>
                  <?php endif; ?>
                </a>
                <div class="cart-hover mt-3">
                <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>">
                  <button class="btn btn-cart">Xem chi tiết</button>
                </a>
              </div>
              </figure>
              <div class="block-4-text p-1">
                <h3><a href="#"><?= $sanPham['ten_san_pham']; ?></a></h3>
                <?php if ($sanPham['gia_khuyen_mai']): ?>
                <p class="text-secondary font-weight-bold">Chỉ còn: <?= number_format($sanPham['gia_khuyen_mai'], 0, ',', '.'); ?> đ</p>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <div class="row" data-aos="fade-up">
          <div class="col-md-12 text-center">
            <div class="site-block-27">
              <ul>
                <li><a href="#">&lt;</a></li>
                <li class="active"><span>1</span></li>
                <li><a href="#">2</a></li>
                
                <li><a href="#">&gt;</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <!-- Sidebar -->
      <div class="col-md-3 order-1 mb-5 mb-md-0">
        <div class="border p-4 rounded mb-4">
          <h3 class="mb-3 h6 text-uppercase text-black d-block">danh mục </h3>
          <ul class="list-unstyled mb-0">
            <li class="mb-1"><a href="#" class="d-flex"><span>hạt </span> <span class="text-black ml-auto">(2,220)</span></a></li>
            <li class="mb-1"><a href="#" class="d-flex"><span>pate</span> <span class="text-black ml-auto">(2,550)</span></a></li>
            <li class="mb-1"><a href="#" class="d-flex"><span>bánh thưởng</span> <span class="text-black ml-auto">(2,124)</span></a></li>
          </ul>
        </div>

        <div class="border p-4 rounded mb-4">
        <div class="mb-4">
            <h3 class="mb-3 h6 text-uppercase text-black d-block">Tìm kiếm </h3>

            <!-- <form method="GET" class="site-block-top-search">
              <span class="icon icon-search2"></span>
              <input type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm" required>
              <input type="hidden" name="act" value="search"> 
              <button type="submit">Tìm kiếm</button>
            </form> -->


            <form action="" class="site-block-top-search" method="GET">
              <span class="icon icon-search2"></span>
              <input type="text" name="keyword" class="form-control border-0" placeholder="Search">
              <input type="hidden" name="act" value="search">
                      
            </form>
          </div>
        </div>
        <div class="mb-4">
          <h3 class="mb-3 h6 text-uppercase text-black d-block">Size</h3>
          <label for="s_sm" class="d-flex">
            <input type="checkbox" id="s_sm" class="mr-2 mt-1"> <span class="text-black">hạt nhỏ</span>
          </label>
          <label for="s_md" class="d-flex">
            <input type="checkbox" id="s_md" class="mr-2 mt-1"> <span class="text-black">hạt to</span>
          </label>
          <label for="s_lg" class="d-flex">
            <input type="checkbox" id="s_lg" class="mr-2 mt-1"> <span class="text-black">cỏ </span>
          </label>
        </div>

        

       
      </div>
    </div>
  </div>
</div>

<?php include './views/layout/footer.php'; ?>
