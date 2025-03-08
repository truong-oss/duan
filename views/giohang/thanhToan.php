<?php include './views/layout/header-nav.php'; ?>
<div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <a href="cart.html">Cart</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Checkout</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
      <form action="<?= BASE_URL . '?act=post-thanh-toan'?>" method="post">

        <div class="row">
          <div class="col-md-6 mb-5 mb-md-0">
            <h2 class="h3 mb-3 text-black">Đặt hàng</h2>
            <div class="p-3 p-lg-5 border">
             
              <div class="form-group row">
                <div class="col-md-12">
                  <label for="c_fname" class="text-black">Họ tên người nhận: <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" value="<?= $user['ho_ten'] ?>" id="c_fname" name="ten_nguoi_nhan" required>
                </div>
                
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="c_companyname" class="text-black">email người nhận: </label>
                  <input type="text" class="form-control" value="<?= $user['email'] ?>" id="c_companyname" name="email_nguoi_nhan" required>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="c_companyname" class="text-black">số điện thoại người nhận: </label>
                  <input type="text" class="form-control" value="<?= $user['so_dien_thoai'] ?>" id="c_companyname" name="sdt_nguoi_nhan" required>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="c_address" class="text-black">Địa chỉ nhận hàng <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_address" name="dia_chi_nguoi_nhan" placeholder="Street address" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="ghi_chu" class="text-black">Ghi chú</label>
                <textarea name="ghi_chu" id="ghi_chu" cols="30" rows="5" class="form-control"  placeholder="vui lòng nhập ghi chú cho đơn hàng nếu cần..."></textarea>
              </div>

            </div>
          </div>
          <div class="col-md-6">

            <div class="row mb-5">
              <div class="col-md-12">
                <div class="p-3 p-lg-5 border">
                  
                  <label for="c_code" class="text-black mb-3">Nhập mã giảm giá ở đây</label>
                  <div class="input-group w-75">
                    <input type="text" class="form-control" id="c_code" placeholder="Nhập....." aria-label="Coupon Code" aria-describedby="button-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary btn-sm" type="button" id="button-addon2">Áp dụng</button>
                    </div>
                  </div>

                </div>
              </div>
            </div>
            
            <div class="row mb-5">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Thông tin đơn hàng</h2>
                <div class="p-3 p-lg-5 border">
                  <table class="table site-block-order-table mb-5">
                    <thead>
                      <th>Sản phẩm</th>
                      <th>Giá</th>
                    </thead>
                    <tbody>
    <?php 
    $tongGioHang = 0; 
    foreach ($chitietGioHang as $key => $sanpham): 
        // Tính tổng tiền cho sản phẩm
        if ($sanpham['gia_khuyen_mai']) {
            $tongTienSanPham = $sanpham['gia_khuyen_mai'] * $sanpham['so_luong'];
        } else {
            $tongTienSanPham = $sanpham['gia_san_pham'] * $sanpham['so_luong'];
        }

        // Cộng dồn vào tổng giỏ hàng
        $tongGioHang += $tongTienSanPham;
    ?>
    <tr>
        <td><?= $sanpham['ten_san_pham'] ?> <strong class="mx-2">x</strong><?= $sanpham['so_luong'] ?></td>
        <td>
            <!-- Hiển thị tổng tiền của sản phẩm, định dạng số -->
            <?= number_format($tongTienSanPham) . " ₫" ?>
        </td>
    </tr>
    <?php endforeach; ?>

    <!-- Phí vận chuyển -->
    <tr>
        <td class="text-black font-weight-bold"><strong>Phí vận chuyển</strong></td>
        <td class="text-black">30,000 ₫</td>
    </tr>

    <!-- Tổng đơn hàng -->
    <tr>
        <td class="text-black font-weight-bold"><strong>Tổng đơn hàng</strong></td>
        <!-- Lưu tổng tiền giỏ hàng (bao gồm phí vận chuyển) -->
        <input type="hidden" name="tong_tien" value="<?= $tongGioHang + 30000 ?>">

        <td class="text-black"><?= number_format($tongGioHang + 30000) . " ₫" ?></td>
    </tr>
</tbody>

                  </table>
                   <div class="single-payment-method show">
                   <div class="single-payment-method show">
                                        <div class="payment-method-name">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="cashon"  value="1" name="phuong_thuc_thanh_toan_id" class="custom-control-input" checked />
                                                <label class="custom-control-label" for="cashon">Thanh toán khi nhận hàng</label>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="single-payment-method">
                                        <div class="payment-method-name">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="directbank"  name="phuong_thuc_thanh_toan_id" value="2" class="custom-control-input" />
                                                <label class="custom-control-label" for="directbank">Thanh toán qua VNpay</label>
                                            </div>
                                        </div>
                                      
                                    </div>
                                  
                                    </div>
                                    
                  <div class="custom-control custom-checkbox mb-20">
                                            <input type="checkbox" class="custom-control-input" id="terms" required />
                                            <label class="custom-control-label" for="terms">Xác nhận đặt hàng</label>
                                        </div>
                  <div class="form-group">
                    <button class="btn btn-primary btn-lg py-3 btn-block" >Đặt hàng</button>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </div>
        </form>
      </div>
    </div>
    <?php include './views/layout/footer.php'; ?>
