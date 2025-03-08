<?php 
session_start();
// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/SanPhamController.php';
require_once './controllers/HomeController.php';
require_once './controllers/ThanhtoanController.php';
require_once './controllers/TaikhoanController.php';
require_once './controllers/DonhangController.php';
require_once './controllers/CartController.php';
// Require toàn bộ file Models
require_once './models/Sanpham.php';
require_once './models/Thanhtoan.php';
require_once './models/Taikhoan.php';
require_once './models/donhang.php';
require_once './models/Cart.php';
// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
  '/' =>(new HomeController)->home(),

    'list-san-pham' => (new  SanPhamController())->Listsanpham(),
    'chi-tiet-san-pham' => (new  SanPhamController())->ChitietSanpham(),
    'thanh-toan' => (new  ThanhtoanController())->formThanhtoan(),
    'post-thanh-toan' => (new  ThanhtoanController())->postThanhtoan(),
    'login' =>(new TaikhoanController())->login(),
    'formlogin' =>(new TaikhoanController())->formlogin(),

    'formregiter'=>(new TaikhoanController())->formregiter(),
    'add-khach-hang' =>(new TaikhoanController())->addtaikhoan(),

    'logout-client' =>(new TaikhoanController())->logout(),

    'them-binh-luan' =>(new SanPhamController())->addbinhluan($_GET['id_san_pham']),
    // tài khoản khách hàng
    'chi-tiet-tai-khoan' =>(new TaikhoanController())->chitiettaikhoan(),
    'update-tai-khoan-client' =>(new TaikhoanController())->updateclient(),
    'form-doi-mk' =>(new TaikhoanController())->formdoimatkhau(),
    'doi-mat-khau' =>(new TaikhoanController())->doimatkhau(),

    'gio-hang'          => (new CartController())->gioHang(),
    'add'     => (new CartController())->addGioHang(),
    // 'them-gio-hang'=>(new HomeController())->addGioHang(),
    // 'gio-hang'=>(new HomeController())->gioHang(),
    // 'update' => (new CartController())->update(),
    // 'remove' => (new CartController())->removeProduct(),


    'update-cart-quantity' => (new CartController())->updateCartQuantity(),
    'delete-cart-item' => (new CartController())->deleteCartItem(),
    
    'search' => (new SanPhamController())->TimKiemSanpham(),
    'don-hang' => (new DonhangController())->danhSachDonhang(),
    'chi-tiet-don-hang' => (new DonhangController())->detaiDonHang($_GET['id_don_hang']),
    'loc-san-pham' => (new SanPhamController())->LocSanpham(),
    'huy-don' => (new DonhangController())->huyDonHang($_GET['id_don_hang'] ?? null),
 
};