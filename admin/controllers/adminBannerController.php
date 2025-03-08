<?php
class AdminBannerControler{
    public $modelBanner;
    public function __construct()
    {
        $this->modelBanner = new AdminBanner();
    }
    public function danhsachBanner(){
        $listBanner = $this->modelBanner->listbanner();
        require_once './views/banner/listBanner.php';
    }
    public function formThemBanner(){
        require_once './views/banner/themBanner.php';
    }
    public function postThemBanner(){
        if($_SERVER['REQUEST_METHOD']== 'POST'){
            $mo_ta = $_POST['mo_ta']?? '';
            $ngay_dang = $_POST['ngay_dang']?? '';
            $trang_thai_id = $_POST['trang_thai_id']?? '';
            $link_anh = $_FILES['link_anh']?? null;
            $file_thumb = uploadFile($link_anh, './uploads/');
            $errors = [];
            if(empty($mo_ta)){
                $errors['mo_ta']='tiêu đề không được để trống';
            }
            if(empty($ngay_dang)){
                $errors['ngay_dang']='ngày đăng không được để trống';
            }
            if(empty($errors)){
                $trang_thai_id = 1;
                 $this->modelBanner->InsertBanner($mo_ta,$ngay_dang,$trang_thai_id, $file_thumb);
                // var_dump($adb);die;
                header("location: " . BASE_URL_ADMIN .'?act=banner' );
                exit();
            }else{
                //trả về form và lỗi
                //đặt chỉ thị xóa session sau khi hiển thị form
               require_once './views/banner/themBanner.php';
            }
        }
    }

    public function DeleteBanner(){
        $id = $_GET['id'];
        $banner = $this->modelBanner->getIDBanner($id);
        if($banner){
            $this->modelBanner->DeleteBanner($id);
            header('Location:'.BASE_URL_ADMIN .'?act=banner');
            exit;
        }
    }

    public function formeditThemBanner(){
        $id = $_GET['id'];
        $banner = $this->modelBanner->getIDBanner($id);
        if($banner){
            require_once './views/banner/editBanner.php';    
        }else{
            header('Location:'.BASE_URL_ADMIN .'?act=banner');
            exit;
        }
    }

    public function posteditThemBanner() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $mo_ta = $_POST['mo_ta'] ?? '';
            $id = $_POST['id'] ?? null;
            $ngay_dang = $_POST['ngay_dang'] ?? '';
            $trang_thai_id = $_POST['trang_thai_id'] ?? '';
            $link_anh = $_FILES['link_anh'] ?? null;
            
            $errors = [];
    
            // Kiểm tra các trường bắt buộc
            if (empty($mo_ta)) {
                $errors['mo_ta'] = 'Tiêu đề không được để trống';
            }
            
            if (empty($ngay_dang)) {
                $errors['ngay_dang'] = 'Ngày đăng không được để trống';
            }
            
            if (empty($id)) {
                $errors['id'] = 'ID không hợp lệ';
            }
    
            // Upload file nếu có file được tải lên
            $file_thumb = null;
            if ($link_anh && $link_anh['error'] === UPLOAD_ERR_OK) {
                $file_thumb = uploadFile($link_anh, './uploads/');
            }
    
            // Nếu không có lỗi, tiến hành cập nhật cơ sở dữ liệu
            if (empty($errors)) {
                $trang_thai_id = 1; // Cập nhật trạng thái
                $this->modelBanner->UpdateBanner($id, $mo_ta, $ngay_dang, $trang_thai_id, $file_thumb);
                
                // Kiểm tra kết quả cập nhật
              
                    // Chuyển hướng nếu thành công
                    header("Location: " . BASE_URL_ADMIN . '?act=banner');
                    exit();
            }else{

         
    
            // Nếu có lỗi, trả lại form với thông tin lỗi
            $banner = ['id' => $id, 'mo_ta' => $mo_ta, 'ngay_dang' => $ngay_dang, 'trang_thai_id' => $trang_thai_id, 'file_thumb' => $file_thumb];
            require_once './views/banner/editBanner.php';
           }
        }
    }
    public function UpdateTrangthai(){
        $id_banner = $_POST['id_banner'];
        $banner = $this->modelBanner->getIDBanner($id_banner);
        if($banner){
            $trang_thai_update = '';
              if ($banner['trang_thai_id'] == 1) {
                $trang_thai_update = 2;
            } else {
                $trang_thai_update = 1;
            }
            $status = $this->modelBanner->updateTrangThaiBanner($id_banner, $trang_thai_update);
            if ($status) {
                header("Location: " . BASE_URL_ADMIN . '?act=banner');
            } else {
                header("Location: " . BASE_URL_ADMIN . '?act=banner');
            }
        }
    }
    }
?>