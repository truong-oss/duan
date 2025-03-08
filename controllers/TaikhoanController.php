<?php
class TaikhoanController
{
    public $taikhoanmodel;
    public function __construct()
    {
        $this->taikhoanmodel = new Taikhoan();
    }
    //
    public function formlogin()
    {
        require_once './views/auth/formlogin.php';
        deleteSessionError();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $mat_khau = $_POST['mat_khau'];
            $user = $this->taikhoanmodel->checklogin($email, $mat_khau);
            if (is_array($user)) {
                $_SESSION['user_client'] = [
                    'id' => $user['id'], 
                    'email' => $user['email'],
                    'ho_ten' => $user['ho_ten'],
                ];
                header("Location: " . BASE_URL);
                exit();
            } else {
                $_SESSION['error'] = $user;
                $_SESSION['flash'] = true;
                header('Location: ' . BASE_URL . '?act=formlogin');
                exit();
            }
        }
    }
    

    public function formregiter()
    {
        require_once './views/auth/formregiter.php';
        deleteSessionError();
    }
    public function addtaikhoan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ho_ten = $_POST['ho_ten'];
            $email = $_POST['email'];
            $mat_khau = $_POST['mat_khau'];
            $so_dien_thoai = $_POST['so_dien_thoai'];
            $errors = [];
            if (empty($email)) {
                $errors['email'] = 'Email không được bỏ trống';
            }
            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Tên không được bỏ trống';
            }
            if (empty($mat_khau)) {
                $errors['mat_khau'] = 'Mật khẩu không được bỏ trống';
            }
            if (empty($so_dien_thoai)) {
                $errors['so_dien_thoai'] = 'Số điện thoại không được bỏ trống';
            }
            if (empty($errors) && $this->taikhoanmodel->checkmail($email)) {
                $errors['email'] = 'Email đã tồn tại vui lòng chọn email khác';
            }
            $_SESSION['error'] = $errors;
            if (empty($errors)) {
                $mat_khau = password_hash($mat_khau, PASSWORD_BCRYPT);
                $chuc_vu = 2;
                $this->taikhoanmodel->addtkkhachhang($ho_ten, $email, $so_dien_thoai, $mat_khau, $chuc_vu);
                $_SESSION['success'] = 'Tạo tài khoản thành công! Bạn có thể đăng nhập ngay.';
                header('location: ' . BASE_URL . '?act=formlogin');
                exit();
            } else {
                $_SESSION['flash'] = true;
                header('location: ' . BASE_URL . '?act=formregiter');
                exit();
            }
        }
    }
    public function chitiettaikhoan()
{
    if (!isset($_SESSION['user_client']['id'])) {
        header('location: ' . BASE_URL . '?act=formlogin');
        exit();
    }
    $user_id = $_SESSION['user_client']['id'];  // Chỉ lấy ID từ session
    $chitiettaikhoan = $this->taikhoanmodel->getuser($user_id);
    require_once './views/taikhoan/taikhoan.php';
}
    public function updateclient()
    {
        if (!isset($_SESSION['user_client']['id'])) {
            header('location: ' . BASE_URL . '?act=formlogin');
            exit();
        }
        $user_id = $_SESSION['user_client']['id'];
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $gioi_tinh = $_POST['gioi_tinh'] ?? '';
            $dia_chi = $_POST['dia_chi'] ?? '';
            $anh_dai_dien = $_FILES['anh_dai_dien'] ?? null;
            $file_thumb = null;
            if ($anh_dai_dien && $anh_dai_dien['error'] === 0) {
                $file_thumb = uploadFile($anh_dai_dien, './uploads/');
            } else {
                $file_thumb = $_POST['anh_dai_dien_cu'] ?? null;
            }
            $errors = [];
            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Họ và tên không được để trống';
            }
            if (empty($email)) {
                $errors['email'] = 'Email không được để trống';
            }
            if (empty($so_dien_thoai)) {
                $errors['so_dien_thoai'] = 'Số điện thoại không được để trống';
            }
            if (empty($dia_chi)) {
                $errors['dia_chi'] = 'Địa chỉ không được để trống';
            }
            $_SESSION['error'] = $errors;
            $updateResult = $this->taikhoanmodel->updateTaiKhoan(
                $user_id,  
                $ho_ten,
                $email,
                $so_dien_thoai,
                $gioi_tinh,
                $dia_chi,
                $file_thumb  
            );
            header("location: " . BASE_URL . '?act=chi-tiet-tai-khoan');
            exit();
        } else {
            $_SESSION['flash'] = true;
            header("location: " . BASE_URL . '?act=chi-tiet-tai-khoan');
            exit();
        }
    }
    public function logout()
    {
        session_unset();
        session_destroy();

        header("Location: " . BASE_URL . "?act=formlogin");
        exit();
    }
    // form đổi mk
    public function formdoimatkhau(){
           // Kiểm tra session trước khi lấy user_id
    $user_id = $_SESSION['user_client']['id'] ?? null;
    
    if ($user_id) {
        $chitiettaikhoan = $this->taikhoanmodel->getuser($user_id);
    } else {
        $chitiettaikhoan = null;
    }
        require_once './views/taikhoan/formsuamk.php';
    }
    // đổi mật khẩu
    public function doimatkhau(){
        if (!isset($_SESSION['user_client']['id'])) {
            header('location: ' . BASE_URL . '?act=formlogin');
            exit();
        }
    
        $user_id = $_SESSION['user_client']['id'];
    
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $mat_khau_cu = $_POST['mat_khau_cu'] ?? '';
            $mat_khau_moi = $_POST['mat_khau_moi'] ?? '';
            $mat_khau_mois = $_POST['mat_khau_mois'] ?? '';
    
            $errors = [];
    
            // Kiểm tra dữ liệu đầu vào
            if (empty($mat_khau_cu)) {
                $errors['mat_khau_cu'] = 'Vui lòng nhập mật khẩu cũ.';
            }
            if (empty($mat_khau_moi)) {
                $errors['mat_khau_moi'] = 'Vui lòng nhập mật khẩu mới.';
            }
            if ($mat_khau_moi !== $mat_khau_mois) {
                $errors['mat_khau_mois'] = 'Xác nhận mật khẩu không khớp.';
            }
    
            if (!empty($errors)) {
                $_SESSION['error'] = $errors;
                header("location: " . BASE_URL . "?act=form-doi-mk");
                exit();
            }
    
            // Lấy mật khẩu hiện tại từ cơ sở dữ liệu
            $currentPassword = $this->taikhoanmodel->getPasswordById($user_id);
    
            // Kiểm tra mật khẩu cũ
            if (!password_verify($mat_khau_cu, $currentPassword)) {
                $_SESSION['error']['mat_khau_cu'] = 'Mật khẩu cũ không chính xác.';
                header("location: " . BASE_URL . "?act=form-doi-mk");
                exit();
            }
    
            // Mã hóa mật khẩu mới
            $hashedPassword = password_hash($mat_khau_moi, PASSWORD_DEFAULT);
    
            // Cập nhật mật khẩu mới
            $this->taikhoanmodel->updatePassword($user_id, $hashedPassword);
    
            $_SESSION['success'] = 'Đổi mật khẩu thành công!';
            header("location: " . BASE_URL . "?act=form-doi-mk");
            exit();
        } else {
            header("location: " . BASE_URL . "?act=form-doi-mk");
            exit();
        }
    }
    

}
