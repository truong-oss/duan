<?php include './views/layout/header-nav.php'; ?>

<div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Contact</strong></div>
        </div>
      </div>
    </div>  

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <span class="icon-check_circle display-3 text-success"></span>
            <h2 class="display-3 text-black">Thank you!</h2>
            <p class="lead mb-5">Cảm ơn quý khách đã mua hàng</p>
            <p><a href="<?= BASE_URL .'?act=list-san-pham' ?>" class="btn btn-sm btn-primary">Back to shop</a></p>
            <p><a href="<?= BASE_URL .'?act=don-hang' ?>" class="btn btn-sm btn">Xem chi tiết đơn hàng</a></p>

          </div>
          
        </div>
      </div>
    </div>
    <?php include './views/layout/footer.php'; ?>
