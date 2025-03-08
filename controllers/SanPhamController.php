<?php 

class SanPhamController
{
    public $modelsanphamm;
    public $taikhoanmodel;

    public function __construct()
    {
        $this->modelsanphamm = new Sanpham();
        $this->taikhoanmodel = new Taikhoan();

    }
    public function Listsanpham(){
        $listSanPham = $this ->modelsanphamm->getAllSanPham();
        $listDanhmuc = $this->modelsanphamm->getAllDanhmuc();
         // Kiểm tra session trước khi lấy user_id
    $user_id = $_SESSION['user_client']['id'] ?? null;
    
    if ($user_id) {
        $chitiettaikhoan = $this->taikhoanmodel->getuser($user_id);
    } else {
        $chitiettaikhoan = null;
    }
        require_once './views/listsanpham/list.php';
        
    }

    public function ChitietSanpham(){
        $id = $_GET['id_san_pham'];
        $listBinhLuan = $this->modelsanphamm->getBinhLuanSanPham($id);
        $sanpham = $this->modelsanphamm->getOnesp($id);
        $listanhsanpham = $this->modelsanphamm->getListAnhsp($id);
        $listdanhmuctheosanpham = $this->modelsanphamm->getSanphamTheodanhmuc($sanpham['danh_muc_id']);
         
         // Kiểm tra session trước khi lấy user_id
    $user_id = $_SESSION['user_client']['id'] ?? null;
    
    if ($user_id) {
        $chitiettaikhoan = $this->taikhoanmodel->getuser($user_id);
    } else {
        $chitiettaikhoan = null;
    }
        require_once './views/listsanpham/ChitietSanpham.php';

    }
    
    public function addbinhluan() {
        $san_pham_id = $_GET['id_san_pham'];
    
        // Kiểm tra đăng nhập
        if (!isset($_SESSION['user_client']) || empty($_SESSION['user_client']['id'])) {
            echo '<script>
        alert("Bạn phải đăng nhập");
        window.history.back();
    </script>';
    exit;
        }
    
        if (isset($_POST['btn_binhluan'])) {
            // Lấy dữ liệu từ form
            $noi_dung = $_POST['noi_dung'];
            $tai_khoan_id = $_SESSION['user_client']['id'];
            $ngay_dang = date('Y-m-d');
            $trang_thai = '1'; // Bình luận được kích hoạt mặc định
            $errors = [];
    
            // Kiểm tra nội dung bình luận
            if (empty($noi_dung)) {
                $errors['noi_dung'] = 'Nội dung không được để trống';
            }
    
            // Nếu không có lỗi, thêm bình luận
            if (empty($errors)) {
                $result = $this->modelsanphamm->getaddbinhluan($tai_khoan_id, $san_pham_id, $noi_dung, $ngay_dang, $trang_thai);
                

                if ($result) {
                    header("Location: " . BASE_URL . "?act=chi-tiet-san-pham&id_san_pham=" . $san_pham_id);
                    exit();
                } else {
                    echo 'Lỗi khi thêm bình luận. Vui lòng thử lại.';
                }
            }
    
            // Lưu lỗi vào session nếu có
            $_SESSION['error'] = $errors;
            $this->ChitietSanpham();
        }
    }
    public function TimKiemSanpham() {
        // Lấy từ khóa tìm kiếm từ URL và làm sạch dữ liệu
        $keyword = trim(strip_tags($_GET['keyword'] ?? ''));
        $listSanPham = $this->modelsanphamm->timKiemSanPham($keyword);
        $listDanhmuc = $this->modelsanphamm->getAllDanhmuc();
         // Kiểm tra session trước khi lấy user_id
    $user_id = $_SESSION['user_client']['id'] ?? null;
    
    if ($user_id) {
        $chitiettaikhoan = $this->taikhoanmodel->getuser($user_id);
    } else {
        $chitiettaikhoan = null;
    }
        require_once './views/listsanpham/list.php';
    }
    public function LocSanpham() {
         // Kiểm tra session trước khi lấy user_id
    $user_id = $_SESSION['user_client']['id'] ?? null;
    
    if ($user_id) {
        $chitiettaikhoan = $this->taikhoanmodel->getuser($user_id);
    } else {
        $chitiettaikhoan = null;
    }
        $danh_muc_id = $_POST['danh_muc'] ?? '';
        if (!empty($danh_muc_id)) {
            $listSanPham = $this->modelsanphamm->getSanphamByDanhMuc($danh_muc_id);
        } else {
            $listSanPham = $this->modelsanphamm->getAllSanPham();
        }
        $listDanhmuc = $this->modelsanphamm->getAllDanhmuc();
        require_once './views/listsanpham/list.php';
    }

}