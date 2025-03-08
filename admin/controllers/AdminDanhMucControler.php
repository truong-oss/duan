<?php
class AdminDanhMucControler
{
    public $modelsDanhMuc;
    public function __construct()
    {
        $this->modelsDanhMuc = new  AdminDanhMuc();
    }
    public function danhsachDanhMuc()
    {
        $listDanhMuc = $this->modelsDanhMuc->getAllDanhMuc();
        require_once './views/DanhMuc/listDanhMuc.php';
    }
    public function formAddDanhmuc()
    {
        require_once './views/DanhMuc/addDanhMuc.php';
    }
    public function AddDanhMuc()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];
            $errors = [];
            if (empty($ten_danh_muc)) {
                $errors['ten_danh_muc'] = "tên danh mục không được bỏ trống";
            }
            if (empty($errors)) {
                $this->modelsDanhMuc->addDanhMuc($ten_danh_muc, $mo_ta);
                header("location: " . BASE_URL_ADMIN . '?act=danh-muc');
                exit();
            } else {
                require_once './views/DanhMuc/addDanhMuc.php';
            }
        }
    }
    public function formSuaDanhMuc()
    {
        $id = $_GET['id_danh_muc'];
        $danhmuc = $this->modelsDanhMuc->getDetailDanhMuc($id);
        if ($danhmuc) {
            require_once './views/DanhMuc/editDanhMuc.php';
        } else {
            header("location: " . BASE_URL_ADMIN . '?act=danh-muc');
            exit();
        }
    }
    public function editDanhMuc()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];
            $errors = [];
            if (empty($ten_danh_muc)) {
                $errors['ten_danh_muc'] = "Tên danh mục không được bỏ trống";
            }
            if (empty($errors)) {
                $this->modelsDanhMuc->updateDanhMuc($id, $ten_danh_muc, $mo_ta);
                header("location: " . BASE_URL_ADMIN . '?act=danh-muc');
                exit();
            } else {
                $danhmuc = ['id' => $id, 'ten_danh_muc' => $ten_danh_muc, 'mo_ta' => $mo_ta];
                require_once './views/DanhMuc/editDanhMuc.php';
            }
        }
    }
    public function deleteDanhMuc()
    {
        $id = $_GET['id_danh_muc'];
        $danhmuc = $this->modelsDanhMuc->getDetailDanhMuc($id);
        if ($danhmuc) {
            $this->modelsDanhMuc->deleteDMuc($id);
        }
        header("location: " . BASE_URL_ADMIN . '?act=danh-muc');
        exit();
    }
}
