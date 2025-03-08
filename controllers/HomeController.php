<?php

class HomeController{
    public $modelSanPham;
    public $taikhoanmodel;

    public function __construct()
    {
        $this->modelSanPham = new SanPham();
        $this->taikhoanmodel = new Taikhoan();

        require_once './views/giohang/giohang.php';
    }
    public function home(){
       $listBanner = $this->modelSanPham->getListBanner();
      $listDanhMuc = $this->modelSanPham->getAllDanhmuc();
        $listSanPham = $this->modelSanPham->getAllSanPham();
         
         // Kiểm tra session trước khi lấy user_id
    $user_id = $_SESSION['user_client']['id'] ?? null;
    
    if ($user_id) {
        $chitiettaikhoan = $this->taikhoanmodel->getuser($user_id);
    } else {
        $chitiettaikhoan = null;
    }
        require_once './views/home.php';
    }
 








}




?>