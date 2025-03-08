<!DOCTYPE html>
<html lang="en">

<head>
  <title>Shoppers &mdash; Colorlib e-Commerce Template</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
  <link rel="stylesheet" href="./assets/fonts/icomoon/style.css">

  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/css/magnific-popup.css">
  <link rel="stylesheet" href="./assets/css/jquery-ui.css">
  <link rel="stylesheet" href="./assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="./assets/css/owl.theme.default.min.css">


  <link rel="stylesheet" href="./assets/css/aos.css">

  <link rel="stylesheet" href="./assets/css/style.css">

</head>

<body>

  <div class="site-wrap">
    <header class="site-navbar" role="banner">
      <div class="site-navbar-top">
        <div class="container">
          <div class="row align-items-center">

            <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
            <form action="" class="site-block-top-search" method="GET">
              <span class="icon icon-search2"></span>
              <input type="text" name="keyword" class="form-control border-0" placeholder="Search">
              <input type="hidden" name="act" value="search">
                      
            </form>
            </div>

            <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
              <a href="<?= BASE_URL ?>">
                <img width="100px" height="100px" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSqHW3ZfmNk9pLznvF8Z06XodmjcJU3osgy1g&s" alt="Shoppers Logo" class="img-fluid">
              </a>
            </div>


            <div class="col-6 col-md-4 order-3 order-md-3 text-right">
              <div class="site-top-icons">
                <ul>

                <li>
    <a href="<?= BASE_URL . '?act=don-hang' ?>">
        <span class="icon icon-bell"></span>
    </a>
</li>
                  <li>
                    <a href="<?= BASE_URL . '?act=gio-hang' ?>" class="site-cart">
                      <span class="icon icon-shopping_cart"></span>
                      <span class="count">2</span>
                    </a>
                  </li>
                  <?php if (isset($_SESSION['user_client']) && !empty($_SESSION['user_client']['id'])): ?>
                    <!-- Nếu đã đăng nhập, hiển thị ảnh đại diện -->
                    <li>
                    <a href="<?= BASE_URL . '?act=chi-tiet-tai-khoan' ?>" class="d-flex align-items-center">
                        <img
                          src="<?= $chitiettaikhoan['anh_dai_dien'] ?>"  alt=""
                          onerror="this.onerror=null;   this.src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTrCcjAUA-4_IjKjNpJpwKLuoXuMktjbhTA5g&s'"
                          alt="Avatar"
                          class="rounded-circle shadow-sm"
                          style="width: 28px; height: 28px; object-fit: cover; display: inline-block; margin-left: 5px;">
                      </a>
                    </li>


                  <?php else: ?>
  <!-- Nếu chưa đăng nhập, hiển thị icon người dùng -->
  <li><a href="<?= BASE_URL . '?act=formlogin' ?>"><span class="icon icon-person"></span></a></li>
                  <?php endif; ?>
                  <li class="d-inline-block d-md-none ml-md-0"><a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a></li>

                </ul>
              </div>

            </div>

          </div>
        </div>
      <nav class="site-navigation text-right text-md-center" role="navigation">
        <div class="container">
          <ul class="site-menu js-clone-nav d-none d-md-block">
            <li>
              <a href="<?= BASE_URL ?>">Trang chủ</a>
            </li>
            
            <li><a href="<?= BASE_URL . '?act=list-san-pham' ?>">Sản phẩm</a></li>
            <li><a href="#">Giới thiệu</a></li>
            <li><a href="">Liên hệ</a></li>
          </ul>
        </div>
      </nav>
    </div>
      
    </header>