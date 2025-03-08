<?php include './views/layout/header-nav.php'; ?>
<?php if (isset($error)): ?>
    <div class="alert alert-danger">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>
<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="shop.html">shop</a></li>
                                <li class="breadcrumb-item active" aria-current="page">cart</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- cart main wrapper start -->
    <div class="cart-main-wrapper section-padding">
        <div class="container">
            <div class="section-bg-color">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Cart Table Area -->
                        <div class="cart-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="pro-thumbnail">Ảnh Sản Phẩm</th>
                                        <th class="pro-title">Tên Sản Phẩm</th>
                                        <th class="pro-price">Giá Tiền</th>
                                        <th class="pro-quantity">Số Lượng</th>
                                        <th class="pro-subtotal">Tổng Tiền</th>
                                        <th class="pro-remove">Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $tongGioHang = 0;
                                    foreach ($chiTietGioHang as $sanPham):

                                    ?>
                                        <tr>
                                            <td class="pro-thumbnail"> <a href="#">
                                                    <img
                                                        class="img-fluid img-thumbnail"
                                                        src="<?= BASE_URL . $sanPham['hinh_anh'] ?>"
                                                        alt="Product"
                                                        style="width: 100px; height: 100px; object-fit: cover;" />
                                                </a></td>
                                            <td class="pro-title"><a href="#"></a><?= $sanPham['ten_san_pham'] ?></td>
                                            <td class="pro-price"><span>
                                                    <?php if ($sanPham['gia_khuyen_mai']) { ?>
                                                        <?= ($sanPham['gia_khuyen_mai']) . ' đ' ?></span></td>
                                        <?php  } else { ?>
                                            <?= ($sanPham['gia_san_pham']) . ' đ' ?></span></td>
                                        <?php  } ?>
                                        <td class="pro-quantity">
                                            <form action="<?= BASE_URL . '?act=update-cart-quantity' ?>" method="post" class="d-inline">
                                                <input type="hidden" name="gio_hang_id" value="<?= $gioHang['id'] ?>">
                                                <input type="hidden" name="san_pham_id" value="<?= $sanPham['san_pham_id'] ?>">
                                                <input type="number" name="so_luong" value="<?= $sanPham['so_luong'] ?>" min="1" class="form-control d-inline w-50">
                                                <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>
                                            </form>
                                        </td>
                                        <td class="pro-subtotal"><span>
                                                <?php
                                                $tongTien = 0;
                                                if ($sanPham['gia_khuyen_mai']) {
                                                    $tongTien = $sanPham['gia_khuyen_mai'] * $sanPham['so_luong'];
                                                } else {
                                                    $tongTien = $sanPham['gia_san_pham'] * $sanPham['so_luong'];
                                                }
                                                $tongGioHang += $tongTien;
                                                echo ($tongTien) . ' đ';
                                                ?>
                                            </span></td>
                                      
                                        <td class="pro-remove">
                                            <a href="<?= BASE_URL . '?act=delete-cart-item&gio_hang_id=' . $gioHang['id'] . '&san_pham_id=' . $sanPham['san_pham_id'] ?>">
                                                <button class="btn btn-primary">Delete</button>
                                            </a>
                                        </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- Cart Update Option -->
                        <div class="cart-update-option d-block d-md-flex justify-content-between">
                            <div class="apply-coupon-wrapper">
                                <form action="#" method="post" class=" d-block d-md-flex">
                                    <input type="text" placeholder="Enter Your Coupon Code" required />
                                    <button class="btn btn-sqr">Apply Coupon</button>
                                </form>
                            </div>
                            <div class="cart-update">
                                <a href="#" class="btn btn-sqr">Update Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 ml-auto">
                        <!-- Cart Calculation Area -->
                        <div class="cart-calculator-wrapper">
                            <div class="cart-calculate-items">
                                <h6>Tổng đơn hàng</h6>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <td>Tổng tiền sản phẩm</td>
                                            <td><?= ($tongGioHang) . ' đ' ?></td>
                                        </tr>
                                        <tr>
                                            <td>Phí vận chuyển</td>
                                            <td>30.000 đ</td>
                                        </tr>
                                        <tr class="total">
                                            <td>Tổng thanh toán</td>
                                            <td class="total-amount"><?= ($tongGioHang + 30000) . ' đ' ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <a href="<?= BASE_URL . '?act=thanh-toan' ?>" class="btn btn-sqr d-block">Tiền hành đặt hàng</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart main wrapper end -->
</main>
<?php include './views/layout/footer.php'; ?>