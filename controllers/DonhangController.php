<?php
class DonhangController {
    public $modelDonHang;
    public $taikhoanmodel;

    public function __construct() {
        $this->modelDonHang = new DonHang();
        $this->taikhoanmodel = new Taikhoan();

    }
    public function danhSachDonhang() {
        $tai_khoan_id = null;

        if (isset($_SESSION['user_client'])) {
            
            $thongtinUser = $this->modelDonHang->getTaiKhoanFormEmail($_SESSION['user_client']['email']);
           
            if ($thongtinUser) {
                $tai_khoan_id = $thongtinUser['id'];
            }
        }
        
        if ($tai_khoan_id) {
            $listdonhang = $this->modelDonHang->getAlldonhangByUser($tai_khoan_id);
        } else {
            $listdonhang = $this->modelDonHang->getAllDonhang();
        }
         
         // Kiểm tra session trước khi lấy user_id
    $user_id = $_SESSION['user_client']['id'] ?? null;
    
    if ($user_id) {
        $chitiettaikhoan = $this->taikhoanmodel->getuser($user_id);
    } else {
        $chitiettaikhoan = null;
    }
        require_once './views/donhang/listDonHang.php';
    }
    // Chi tiết đơn hàng
    public function detaiDonHang() {
           // Kiểm tra session trước khi lấy user_id
    $user_id = $_SESSION['user_client']['id'] ?? null;
    
    if ($user_id) {
        $chitiettaikhoan = $this->taikhoanmodel->getuser($user_id);
    } else {
        $chitiettaikhoan = null;
    }
        // Kiểm tra xem ID đơn hàng có được gửi không và hợp lệ
        if (!isset($_GET['id_don_hang']) || !is_numeric($_GET['id_don_hang'])) {
            echo "ID đơn hàng không hợp lệ.";
            return;
        }
    
        $id_don_hang = $_GET['id_don_hang'];
        // Lấy thông tin chi tiết đơn hàng từ model
        $donHang = $this->modelDonHang->getIDDonHang($id_don_hang);
        // Kiểm tra nếu không có dữ liệu đơn hàng
        if ($donHang === null || $donHang === false) {
            echo "Không tìm thấy thông tin đơn hàng.";
            return;
        }
        $sanPhamDonHang = $this->modelDonHang->getListSpDonHang($id_don_hang);
        
        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();
        if (!is_array($sanPhamDonHang)) {
            $sanPhamDonHang = [];
        }
        require_once './views/donhang/theo-doi.php';
    }
    
    
    // public function huyDonHang($id_don_hang) {
    //     // Kiểm tra session trước khi lấy user_id
    //     $user_id = $_SESSION['user_client']['id'] ?? null;
    
    //     // Trạng thái "Đơn hàng đã hủy" là 10 (theo mã số của bạn)
    //     $trang_thai_huy = 10;
    
    //     // Lấy trạng thái hiện tại của đơn hàng
    //     $donHang = $this->modelDonHang->getIDDonHang($id_don_hang); 
    
    //     if (!$donHang) {
    //         echo "<script>
    //                 alert('Đơn hàng không tồn tại.');
    //                 window.location.href = '?act=don-hang';
    //               </script>";
    //         return;
    //     }
    
    //     // Kiểm tra trạng thái của đơn hàng
    //     $trang_thai_hien_tai = $donHang['trang_thai_don_hang_id']; // Giả sử 'trang_thai_don_hang_id' lưu trạng thái đơn hàng
    
    //     // Chỉ cho phép hủy nếu trạng thái là 1
    //     if ($trang_thai_hien_tai != 1) {
    //         echo "<script>
    //                 alert('Bạn không thể hủy hàng khi đã xác nhận');
    //                 window.location.href = '?act=don-hang'; 
    //               </script>";
    //         return;
    //     }
    
    //     // Thực hiện hủy đơn hàng
    //     $result = $this->modelDonHang->updateTrangThaiDonHang($id_don_hang, $trang_thai_huy);
        
    //     if ($result) {
    //         echo "<script>
    //                 alert('Đơn hàng đã hủy thành công!');
    //               </script>";
    
    //         // Lấy thông tin người dùng để lấy danh sách đơn hàng
    //         $tai_khoan_id = null;
    //         if (isset($_SESSION['user_client'])) {
    //             $thongtinUser = $this->modelDonHang->getTaiKhoanFormEmail($_SESSION['user_client']['email']);
    //             if ($thongtinUser) {
    //                 $tai_khoan_id = $thongtinUser['id'];
    //             }
    //         }
    
    //         // Lấy danh sách đơn hàng của người dùng sau khi hủy đơn thành công
    //         $listdonhang = $this->modelDonHang->getAlldonhangByUser($tai_khoan_id);
    
    //         // Hiển thị lại danh sách đơn hàng
    //         require_once './views/donhang/listDonHang.php'; 
    //     } else {
    //         echo "<script>
    //                 alert('Có lỗi xảy ra khi hủy đơn hàng.');
    //                 window.location.href = '?act=don-hang'; // Chuyển hướng về trang danh sách đơn hàng
    //               </script>";
    //     }
    // }
    
    
    public function huyDonHang($id_don_hang) {
        // Trạng thái "Đơn hàng đã hủy" là 10 (theo mã số của bạn)
        $trang_thai_huy = 10;
    
        // Lấy trạng thái hiện tại của đơn hàng
        $donHang = $this->modelDonHang->getIDDonHang($id_don_hang); 
    
        if (!$donHang) {
            echo "<script>
                    alert('Đơn hàng không tồn tại.');
                    window.location.href = '?act=don-hang';
                  </script>";
            return;
        }
    
        // Kiểm tra trạng thái của đơn hàng
        $trang_thai_hien_tai = $donHang['trang_thai_don_hang_id'];
    
        // Chỉ cho phép hủy nếu trạng thái là 1
        if ($trang_thai_hien_tai != 1) {
            echo "<script>
                    alert('Bạn không thể hủy hàng khi đã xác nhận');
                    window.location.href = '?act=don-hang'; 
                  </script>";
            return;
        }
    
        // Thực hiện hủy đơn hàng
        $result = $this->modelDonHang->updateTrangThaiDonHang($id_don_hang, $trang_thai_huy);
        
        if ($result) {
            echo "<script>
                    alert('Đơn hàng đã hủy thành công!');
                  </script>";
    
            // Kiểm tra trạng thái đăng nhập
            $user_id = $_SESSION['user_client']['id'] ?? null;
    
            if ($user_id) {
                // Nếu người dùng đã đăng nhập, hiển thị đơn hàng của họ
                $listdonhang = $this->modelDonHang->getAlldonhangByUser($user_id);
            } else {
                // Nếu người dùng chưa đăng nhập, hiển thị tất cả đơn hàng
                $listdonhang = $this->modelDonHang->getAllDonhang();
            }
    
            require_once './views/donhang/listDonHang.php'; // Hiển thị danh sách đơn hàng
        } else {
            echo "<script>
                    alert('Có lỗi xảy ra khi hủy đơn hàng.');
                    window.location.href = '?act=don-hang'; // Chuyển hướng về trang danh sách đơn hàng
                  </script>";
        }
    }
    
}