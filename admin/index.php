 
<?php
session_start(); 

// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/AdminBaoCaoThongKe.php';
require_once './controllers/AdminDanhMucControler.php';
require_once './controllers/adminBannerController.php';
require_once './controllers/AdminSanPhamController.php';
require_once './controllers/AdminTaiKhoan.php';
require_once './controllers/adminDonhangController.php';

// Require toàn bộ file Models
require_once './models/adminBanner.php';
require_once './models/AdminDanhMuc.php';
require_once './models/AdminSanPham.php';
require_once './models/AdminTaiKhoan.php';
require_once './models/donhang.php';
require_once './models/Reportmodel.php';
require_once './models/Chartmodel.php';
require_once './models/dashboard.php';

// Route
$act = $_GET['act'] ?? '/';
if($act !== 'login-admin' && $act !== 'check-login-admin' && $act !== 'logout-admin'){
    checkLoginAdmin(); 
}
// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Trang chủ
    '/' => (new AdminBaoCaoThongKe())->home(),
    'danh-muc' => (new AdminDanhMucControler())->danhsachDanhMuc(),
    'form-them-danh-muc' => (new AdminDanhMucControler())->formAddDanhmuc(),
    'them-danh-muc' => (new AdminDanhMucControler())->AddDanhMuc(),
    'form-sua-danh-muc' => (new AdminDanhMucControler())->formSuaDanhMuc(),
    'sua-danh-muc' => (new AdminDanhMucControler())->editDanhMuc(),
    'xoa-danh-muc' => (new AdminDanhMucControler())->deleteDanhMuc(),
    //sản phẩm
    'san-pham' => (new  AdminSanPhamController())->danhsachsanpham(),
    'form-them-san-pham' => (new  AdminSanPhamController())->formAddSanPham(),
    'them-san-pham' => (new  AdminSanPhamController())->postAddsanpham(),
    'form-sua-san-pham' => (new  AdminSanPhamController())->formEditSanPham(),
    'sua-san-pham' => (new AdminSanPhamController())->postEditSanPham(),
    'sua-album-anh-san-pham' => (new  AdminSanPhamController())->postEditAnhSanPham(),

    'xoa-san-pham' => (new AdminSanPhamController())->deleteSanPham(),
    'chi-tiet-san-pham' => (new AdminSanPhamController())->detailSanPham(),
    //bình luận
    'update-trang-thai-binh-luan' =>(new AdminSanPhamController())->updateTrangThaiBinhLuan(),


     //tk
    'quan-tri-tai-khoan' => (new AdminTaiKhoanController ())->danhSachQuanTri(),
    'form-them-quan-tri' => (new AdminTaiKhoanController ())->formAddQuanTri(),
    'them-quan-tri' => (new AdminTaiKhoanController ())->postAddQuanTri(),
    'form-sua-quan-tri'=> (new AdminTaiKhoanController())->formEditQuanTri(),
      'sua-quan-tri'=> (new AdminTaiKhoanController())->postEditQuanTri(),
    'delete-quan-tri' => (new AdminTaiKhoanController ())->postDeleteTaiKhoan(),

    'quan-tri-tai-khoan-khach-hang' => (new AdminTaiKhoanController ())->danhSachKhachHang(),
    'form-sua-khach-hang' => (new AdminTaiKhoanController())->formEditKhachhang(),
    'chi-tiet-khach-hang'=> (new AdminTaiKhoanController())->deltailKhachHang(),
    'sua-khach-hang'=> (new AdminTaiKhoanController())->postEditKhachHang(),
    'delete-khach-hang'=> (new AdminTaiKhoanController())->postDeletekhachhang(),

    'login-admin' => (new AdminTaiKhoanController())->formLogin(),
    'check-login-admin' => (new AdminTaiKhoanController())->login(),

      // đơn hàng
      'don-hang' => (new adminDonhangController())->danhSachDonhang(),
      'chi-tiet-don-hang' =>(new adminDonHangController)->detaiDonHang($_GET['id_don_hang']),
      'form-sua-don-hang' =>(new AdminDonHangController())->formEditDonHang(),
      'sua-don-hang' =>(new AdminDonHangController())->postEditDonHang(),
      // banner
      'banner' =>(new AdminBannerControler())->danhsachBanner(),
      'form-them-banner'=> (new AdminBannerControler())->formThemBanner(),
      'form-edit-banner'=> (new AdminBannerControler())->formeditThemBanner(),
      'post-edit-banner'=> (new AdminBannerControler())->posteditThemBanner(),
      'post-them-banner'=> (new AdminBannerControler())->postThemBanner(),
      'delete-banner'=> (new AdminBannerControler())->DeleteBanner(),
      'update-trang-thai'=> (new AdminBannerControler())->UpdateTrangthai(),
     
};
