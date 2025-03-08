<?php

class CartController {
    public $modelCart;
    public $taikhoanmodel;
    public $modelsanphammm;
    public function __construct() {
        $this->modelCart = new Cart();
        $this->taikhoanmodel = new Taikhoan();
        $this->modelsanphammm = new Sanpham();
    }



    public function addGioHang() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
            $san_pham_id = $_GET['id_san_pham'] ?? null;
            $so_luong = $_POST['so_luong'] ?? 1;
    
            // Kiểm tra nếu người dùng đã đăng nhập
            if (isset($_SESSION['user_client'])) {
                // Lấy thông tin người dùng từ session
                $mail = $this->taikhoanmodel->checkmail($_SESSION['user_client']['email']);
if (is_array($mail)) {
    // Giả sử trả về một mảng chứa thông tin người dùng
    $gioHang = $this->modelCart->getGioHangFromUser($mail['id']);
    // Nếu không có giỏ hàng, tạo mới giỏ hàng
    if (!$gioHang) {
        $gioHangId = $this->modelCart->addGioHang($mail['id']);
        $gioHang = ['id' => $gioHangId];
    }
} else {
    // Xử lý trường hợp không tìm thấy người dùng
    echo 'Lỗi: Không tìm thấy người dùng';
}

                
                // Lấy chi tiết giỏ hàng của người dùng
                $chiTietGioHang = $this->modelCart->getDetailGioHang($gioHang['id']);
            } else {
                // Nếu người dùng chưa đăng nhập, lấy giỏ hàng từ session_id
                $session_id = session_id();
                $gioHang = $this->modelCart->getGioHangBySessionId($session_id);
                // var_dump($gioHang);die;
    
                if (!$gioHang) {
                    $gioHangId = $this->modelCart->addGioHang(null, $session_id);
                    $gioHang = ['id' => $gioHangId];
                }
                $chiTietGioHang = $this->modelCart->getDetailGioHang($gioHang['id']);
            }
    
            // Kiểm tra sản phẩm đã có trong giỏ chưa
            $checkSanPham = false;
            foreach ($chiTietGioHang as $detail) {
                if ($detail['san_pham_id'] == $san_pham_id) {
                    $newSoLuong = $detail['so_luong'] + $so_luong;
                    $this->modelCart->updateSoLuong($gioHang['id'], $san_pham_id, $newSoLuong);
                    $checkSanPham = true;
                    break;
                }
            }
    
            // Nếu sản phẩm chưa có trong giỏ, thêm mới vào giỏ hàng
            if (!$checkSanPham) {
                $this->modelCart->addDetailGioHang($gioHang['id'], $san_pham_id, $so_luong);
            }
    
            // Chuyển hướng người dùng đến trang giỏ hàng
            header('Location: ' . BASE_URL . '?act=gio-hang');
        }
    }
    
   

    public function gioHang() {
        $listDanhmuc = $this->modelsanphammm->getAllDanhMuc();
         // Kiểm tra session trước khi lấy user_id
    $user_id = $_SESSION['user_client']['id'] ?? null;
    
    if ($user_id) {
        $chitiettaikhoan = $this->taikhoanmodel->getuser($user_id);
    } else {
        $chitiettaikhoan = null;
    }
        if (isset($_SESSION['user_client'])) {
            // Người dùng đã đăng nhập
            $mail = $this->taikhoanmodel->checkmail($_SESSION['user_client']['email']);
            
            if (is_array($mail)) {
                $gioHang = $this->modelCart->getGioHangFromUser($mail['id']); // Lấy giỏ hàng từ tài khoản
    
                if (!$gioHang) {
                    $gioHangId = $this->modelCart->addGioHang($mail['id']);
                    $gioHang = ['id' => $gioHangId];
                }
    
                $chiTietGioHang = $this->modelCart->getDetailGioHang($gioHang['id']);
            } else {
                // Nếu không tìm thấy người dùng, xử lý lỗi
                $error = 'Không tìm thấy tài khoản người dùng';
            }
        } else {
            // Người dùng chưa đăng nhập, lấy giỏ hàng từ session_id
            $session_id = session_id();
            $gioHang = $this->modelCart->getGioHangBySessionId($session_id);
    
            if (!$gioHang) {
                $gioHangId = $this->modelCart->addGioHang(null, $session_id);
                $gioHang = ['id' => $gioHangId];
            }
            $chiTietGioHang = $this->modelCart->getDetailGioHang($gioHang['id']);
        }
    
        require_once './views/cart/cart.php';
    }
    public function updateCartQuantity() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $gio_hang_id = $_POST['gio_hang_id'] ?? null;
            $san_pham_id = $_POST['san_pham_id'] ?? null;
            $so_luong = $_POST['so_luong'] ?? null;
    
            if ($gio_hang_id && $san_pham_id && $so_luong) {
                $this->modelCart->updateSoLuong($gio_hang_id, $san_pham_id, $so_luong);
            }
    
            header('Location: ' . BASE_URL . '?act=gio-hang');
            exit();
        }
    }
public function deleteCartItem() {
    if (isset($_GET['gio_hang_id']) && isset($_GET['san_pham_id'])) {
        $gio_hang_id = $_GET['gio_hang_id'];
        $san_pham_id = $_GET['san_pham_id'];
        $this->modelCart->deleteSanPhamGioHang($gio_hang_id, $san_pham_id);
    }

    header('Location: ' . BASE_URL . '?act=gio-hang');
    exit();
}
    
}
