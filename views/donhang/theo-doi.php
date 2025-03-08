<?php include './views/layout/header-nav.php'; ?>
<style>
    /* Styles here as provided */
</style>

<div class="bg-light py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0">
                <a href="index.html">Trang Chủ</a>
                <span class="mx-2 mb-0">/</span>
                <strong class="text-black">Theo Dõi Đơn Hàng</strong>
            </div>
        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-12 order-1 mb-5 mb-md-0">
                <h2 class="text-black h2 mb-4">Thông Tin Đơn Hàng</h2>
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="mb-3 h6 text-uppercase text-black">mã đơn hàng : <td><?= $donHang['ma_don_hang'] ?></td></h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tên Sản Phẩm</th>
                                    <th>Số Lượng</th>
                                    <th>Mô Tả</th>
                                    <th>Đơn Giá</th>
                                    <th>Trạng Thái</th>
                                    <th>Trạng Thái Giao Hàng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($sanPhamDonHang)): ?>
                                    <?php foreach ($sanPhamDonHang as $spdonhang): ?>
                                        
                                        <tr>

                                            <td>
                                                <img src="<?= $spdonhang['hinh_anh'] ?>" class="img-fluid" alt="<?= $spdonhang['ten_san_pham'] ?>" style="width: 50px; height: auto;">
                                                <?= $spdonhang['ten_san_pham'] ?>
                                            </td>
                                            <td><?= $spdonhang['so_luong'] ?></td>
                                            <td><?= $spdonhang['mo_ta'] ?></td>
                                            <td><?= number_format($spdonhang['don_gia'], 0, ',', '.') ?> VND</td>
                                            <td><?= $spdonhang['ten_trang_thais'] ?></td>
                                            <td><?= $spdonhang['ten_trang_thai'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">Không có sản phẩm nào trong đơn hàng.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <?php if (!empty($sanPhamDonHang)): ?>
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="mb-3 h6 text-uppercase text-black">Thông Tin Người Nhận</h3>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Tên</th>
                                    <td><?= $donHang['ten_nguoi_nhan'] ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?= $donHang['email_nguoi_nhan'] ?></td>
                                </tr>
                                <tr>
                                    <th>Số Điện Thoại</th>
                                    <td><?= $donHang['sdt_nguoi_nhan'] ?></td>
                                </tr>
                                <tr>
                                    <th>Địa Chỉ</th>
                                    <td><?= $donHang['dia_chi_nguoi_nhan'] ?></td>
                                </tr>
                                <tr>
                                    <th>Ngày Đặt</th>
                                    <td><?= $donHang['ngay_dat'] ?></td>
                                </tr>
                                <tr>
                                    <th>Tổng Tiền</th>
                                    <td><?= number_format($donHang['tong_tien'], 0, ',', '.') ?> VND</td>
                                </tr>
                                <tr>
                                    <th>Trạng Thái Thanh Toán</th>

                                    <td><?= $spdonhang['ten_hinh_thuc'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php endif; ?>

                <div class="text-center mb-4">
                <a href="<?= BASE_URL . '?act=list-san-pham' ?>" class="btn btn-primary">Quay Lại Trang Chủ</a>
                <a href="<?= BASE_URL . '?act=huy-don&id_don_hang=' . $donHang['id'] ?>" class="btn btn-danger">Hủy Đơn</a>

                </div>
             

            </div>
        </div>
    </div>
</div>
<?php include './views/layout/footer.php'; ?>