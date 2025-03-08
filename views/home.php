<?php include './views/layout/header-nav.php' ?>
<!-- banner -->
<div id="slideshow" class="carousel slide site-blocks-cover" data-ride="carousel">
  <!-- Slides -->
  <div class="carousel-inner">
    <?php foreach ($listBanner as $key => $banner): ?>
      <div class="carousel-item <?= $key === 0 ? 'active' : '' ?>" style="background-image: url(<?= $banner['link_anh'] ?>);">
        <div class="container">
          <div class="row align-items-start align-items-md-center justify-content-end">
            <div class="col-md-5 text-center text-md-left pt-5 pt-md-0">
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Controls -->
  <a class="carousel-control-prev" href="#slideshow" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#slideshow" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<!-- end banner -->

<div class="site-section site-section-sm site-blocks-1">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="">
        <div class="icon mr-4 align-self-start">
          <span class="icon-truck"></span>
        </div>
        <div class="text">
          <h2 class="text-uppercase">Free Shipping</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam. Integer accumsan tincidunt fringilla.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="100">
        <div class="icon mr-4 align-self-start">
          <span class="icon-refresh2"></span>
        </div>
        <div class="text">
          <h2 class="text-uppercase">Free Returns</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam. Integer accumsan tincidunt fringilla.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="200">
        <div class="icon mr-4 align-self-start">
          <span class="icon-help"></span>
        </div>
        <div class="text">
          <h2 class="text-uppercase">Customer Support</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam. Integer accumsan tincidunt fringilla.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="site-section site-blocks-2 py-5">
  <div class="container">
    <div class="row">
      <!-- CỎ MÈO -->
      <div class="col-sm-6 col-md-6 col-lg-4 mb-4">
        <a class="block-2-item d-flex flex-column align-items-center text-decoration-none" href="<?= BASE_URL . '?act=list-san-pham' ?>">
          <figure class="image position-relative">
            <img src="https://photo2.tinhte.vn/data/attachment-files/2023/07/6496987_Cover_meo.png" 
                 alt="Cỏ Mèo" class="img-fluid rounded shadow-lg img-fixed">
            <div class="overlay d-flex justify-content-center align-items-center">
              <h4 class="text-center text-white fw-bold">CỎ MÈO</h4>
            </div>
          </figure>
        </a>
      </div>

      <!-- THỨC ĂN HẠT -->
      <div class="col-sm-6 col-md-6 col-lg-4 mb-4">
        <a class="block-2-item d-flex flex-column align-items-center text-decoration-none" href="<?= BASE_URL . '?act=list-san-pham' ?>">
          <figure class="image position-relative">
            <img src="https://file.hstatic.net/200000159621/article/3.3__1__72cfef22ab2b435ea1d2b8ab13213028_grande.jpg" 
                 alt="Thức Ăn Hạt" class="img-fluid rounded shadow-lg img-fixed">
            <div class="overlay d-flex justify-content-center align-items-center">
              <h4 class="text-center text-white fw-bold">THỨC ĂN HẠT</h4>
            </div>
          </figure>
        </a>
      </div>

      <!-- PATE -->
      <div class="col-sm-6 col-md-6 col-lg-4 mb-4">
        <a class="block-2-item d-flex flex-column align-items-center text-decoration-none" href="<?= BASE_URL . '?act=list-san-pham' ?>">
          <figure class="image position-relative">
            <img src="https://kinpetshop.com/wp-content/uploads/hat-cho-meo-con.jpg" 
                 alt="Pate" class="img-fluid rounded shadow-lg img-fixed">
            <div class="overlay d-flex justify-content-center align-items-center">
              <h4 class="text-center text-white fw-bold">PATE</h4>
            </div>
          </figure>
        </a>
      </div>
    </div>
  </div>
</div>



<div class="site-section block-3 site-blocks-2 bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-7 site-section-heading text-center pt-4">
        <h2>Sản phẩm</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="nonloop-block-3 owl-carousel">
          <!-- hiển thị -->
          <?php foreach ($listSanPham as $key => $sanPham): ?>
            <div class="item">
              <div class="block-4 text-center">
                <figure class="block-4-image" <?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>>
                  <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>">

                    <img width="300px" height="300px" style="object-fit: cover;" class="sec-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                  </a>
                  <div class="product-badge">
                    <?php
                    $ngayNhap = new DateTime($sanPham['ngay_nhap']);
                    $ngayHienTai = new DateTime();
                    $tinhNgay = $ngayHienTai->diff($ngayNhap);

                    if ($tinhNgay->days <= 7) { ?>
                      <div class="product-label new">
                        <span>Mới</span>
                      </div>
                    <?php }
                    ?>
                    <?php if ($sanPham['gia_khuyen_mai']) { ?>
                      <div style="margin-top: 30px;" class="product-label discount">
                        <span>Giảm giá: </span>
                        <span style="color: red;"><del><?= $sanPham['gia_san_pham'] ?> đ</del></span>
                      </div>
                    <?php  } ?>

                  </div>

                  <div class="cart-hover">
                    <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                      <button class="btn btn-cart">Xem chi tiết</button>
                    </a>

                  </div>
                </figure>
                <div class="block-4-text p-4">
                  <h3><a href="#"></a></h3>
                  <p class="mb-0">chỉ còn</p>
                  <?php if ($sanPham['gia_khuyen_mai']) { ?>
                    <p class="text-primary font-weight-bold">
                      <?= $sanPham['gia_khuyen_mai'] ?> đ
                    </p>
                  <?php } ?>
                </div>
              </div>
            </div>
          <?php endforeach ?>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="site-section block-8">
  <div class="container">
    <div class="row justify-content-center  mb-5">
      <div class="col-md-7 site-section-heading text-center pt-4">
        <h2>Big Sale!</h2>
      </div>
    </div>
    <div class="row align-items-center">
      <div class="col-md-12 col-lg-7 mb-5">
        <a href="#"><img height="440px" width="100%" src="https://channel.mediacdn.vn/2020/10/7/image001-1602064182156962005532.jpg" alt="Image placeholder" ></a>
      </div>
      <div class="col-md-12 col-lg-5 text-center pl-md-5">
        <h2><a href="#">50% less in all items</a></h2>
        <p class="post-meta mb-4">By <a href="#">Carl Smith</a> <span class="block-8-sep">&bullet;</span> September 3, 2018</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam iste dolor accusantium facere corporis ipsum animi deleniti fugiat. Ex, veniam?</p>
        <p><a href="#" class="btn btn-primary btn-sm">Shop Now</a></p>
      </div>
    </div>
  </div>
</div>
<?php include './views/layout/footer.php' ?>
</body>
</html>