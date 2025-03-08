<?php

class ThanhtoanController{
    public $modelThanhtoan;
    public $taikhoanmodel;

    public function __construct()
    {
        $this->modelThanhtoan = new Thanhtoan();
        $this->taikhoanmodel = new Taikhoan();

    }

    public function formThanhtoan() {
         // Kiểm tra session trước khi lấy user_id
    $user_id = $_SESSION['user_client']['id'] ?? null;
    
    if ($user_id) {
        $chitiettaikhoan = $this->taikhoanmodel->getuser($user_id);
    } else {
        $chitiettaikhoan = null;
    }
        // Kiểm tra nếu người dùng đã đăng nhập
        $giohang = null;
        if (isset($_SESSION['user_client'])) {
            // Nếu đã đăng nhập, lấy giỏ hàng từ tai_khoan_id
            $giohang = $this->modelThanhtoan->getGioHangFormId($_SESSION['user_client']['id']);
        } else {
            // Nếu chưa đăng nhập, lấy giỏ hàng từ session_id
            $session_id = session_id();
            $giohang = $this->modelThanhtoan->getGioHangFormId(null, $session_id);
        }
    
        // Nếu chưa có giỏ hàng, tạo giỏ hàng mới
        if (!$giohang) {
            $giohangid = $this->modelThanhtoan->AddGioHang(null, $session_id);  // Thêm giỏ hàng với session_id
            $giohang = ['id' => $giohangid];
        }
    
        // Lấy chi tiết giỏ hàng
        $chitietGioHang = $this->modelThanhtoan->getDetailGioHang($giohang['id']);
    
        // Khởi tạo biến $user
        $user = [
            'ho_ten' => '',
            'email' => '',
            'so_dien_thoai' => '',
        ];
    
        // Nếu người dùng đã đăng nhập, lấy thông tin tài khoản
        if (isset($_SESSION['user_client'])) {
            $thongtinUser = $this->modelThanhtoan->getTaiKhoanFormEmail($_SESSION['user_client']['email']);
            if ($thongtinUser) {
                $user['ho_ten'] = $thongtinUser['ho_ten'];
                $user['email'] = $thongtinUser['email'];
                $user['so_dien_thoai'] = $thongtinUser['so_dien_thoai'];
            }
        }
    
        // Chuyển đổi mảng $user thành các biến
        foreach ($user as $key => $value) {
            $$key = $value;
        }
    
        // Gọi view thanh toán
        require_once './views/giohang/thanhToan.php';
    }
    
    
    
    public function postThanhtoan() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'];
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'];
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'];
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'];
            $ghi_chu = $_POST['ghi_chu'];
            $tong_tien = $_POST['tong_tien'];
            $phuong_thuc_thanh_toan_id = $_POST['phuong_thuc_thanh_toan_id'];
            
            // Tiếp tục xử lý nếu không có lỗi
            $ngay_dat = date('Y-m-d');
            $trang_thai_don_hang_id = 1;
            $trang_thai_thanh_toan_id = 1;
    
            // Kiểm tra nếu đã đăng nhập, lấy tai_khoan_id, nếu chưa lấy session_id
            if (isset($_SESSION['user_client'])) {
                $tai_khoan_id = $this->modelThanhtoan->getTaiKhoanFormEmail($_SESSION['user_client']['email'])['id'];
            } else {
                $tai_khoan_id = null; // Khi chưa đăng nhập
            }
    
            $ma_don_hang = 'DH-' . rand(1000, 9999);
            
            // Thêm đơn hàng vào cơ sở dữ liệu
            $don_hang_id = $this->modelThanhtoan->addDonHang(
                $tai_khoan_id,
                $ten_nguoi_nhan,
                $email_nguoi_nhan,
                $sdt_nguoi_nhan,
                $dia_chi_nguoi_nhan,
                $ghi_chu,
                $tong_tien,
                $ngay_dat,
                $phuong_thuc_thanh_toan_id,
                $ma_don_hang,
                $trang_thai_don_hang_id,
                $trang_thai_thanh_toan_id
            );
    
            if ($don_hang_id) {
                // Lấy giỏ hàng từ tai_khoan_id hoặc session_id
                if (isset($_SESSION['user_client'])) {
                    $giohang = $this->modelThanhtoan->getGioHangFormId($tai_khoan_id);
                } else {
                    $session_id = session_id();
                    $giohang = $this->modelThanhtoan->getGioHangFormId(null, $session_id);
                }
    
                $chitietGioHang = $this->modelThanhtoan->getDetailGioHang($giohang['id']);
                foreach ($chitietGioHang as $item) {
                    $this->modelThanhtoan->addChiTietDonHang(
                        $don_hang_id,
                        $item['san_pham_id'],
                        $item['so_luong'],
                        $item['gia_san_pham'],
                        $item['gia_khuyen_mai']
                    );
                }
    
                // Xóa giỏ hàng sau khi hoàn thành thanh toán
                $this->modelThanhtoan->clearGioHang($giohang['id']);
                require_once './views/giohang/camon.php';
                die;
            } else {
                echo 'Lỗi khi xử lý đơn hàng!';
            }
        } else {
            echo 'Yêu cầu không hợp lệ.';
            die;
        }
    }
    

}

?>