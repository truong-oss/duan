<?php
class AdminTaiKhoan
{

    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllTaiKhoan($chuc_vu)
    {
        try {
            $sql = 'SELECT * FROM tai_khoans where chuc_vu = :chuc_vu';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':chuc_vu' => $chuc_vu]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }
    public function insertTaiKhoan($ho_ten, $email, $password, $dien_thoai,$ngay_sinh, $gioi_tinh,$chuc_vu)
    {
        try {
            $sql = 'INSERT INTO tai_khoans(ho_ten, email, mat_khau, so_dien_thoai, ngay_sinh ,gioi_tinh,chuc_vu)
            VALUES (:ho_ten, :email, :password, :so_dien_thoai,:ngay_sinh,:gioi_tinh, :chuc_vu)'; 
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ho_ten' => $ho_ten,
                ':email' => $email,
                ':password' => $password,
                ':so_dien_thoai' => $dien_thoai, 
                ':ngay_sinh' => $ngay_sinh, 
                ':gioi_tinh' => $gioi_tinh, 
                ':chuc_vu' => $chuc_vu
            ]);
            return true;
        } catch (Exception $e) {
            echo "lỗi: " . $e->getMessage();
        }
    }
    public function deleteTaiKhoan($id_quan_tri)
    {
        try {
            // Tạo câu lệnh SQL để xóa tài khoản theo id
            $sql = 'DELETE FROM tai_khoans WHERE id = :id_quan_tri';
            $stmt = $this->conn->prepare($sql);

            // Thực thi câu lệnh SQL
            $stmt->execute([':id_quan_tri' => $id_quan_tri]);

            // Kiểm tra xem có bị ảnh hưởng dòng nào không
            return $stmt->rowCount() > 0;
        } catch (Exception $e) {
            error_log('Lỗi khi xóa tài khoản: ' . $e->getMessage());
            return false; // Nếu có lỗi, trả về false
        }
    }
    public function getDetailTaiKhoan($id)
    {
        try {
            $sql = 'SELECT * FROM tai_khoans where id = :id';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
            var_dump($stmt);
            die;
        } catch (Exception $e) {
            echo 'lỗi ' . $e->getMessage();
        }
    }
    public function UpdatTaiKhoan($id,$ho_ten,$email,$so_dien_thoai,$trang_thai){
        try {
            $sql = 'UPDATE tai_khoans  SET 
            ho_ten = :ho_ten,
            email=:email,
            so_dien_thoai=:so_dien_thoai,
            trang_thai=:trang_thai
            
            where id = :id';            
            $stmt = $this->conn->prepare($sql);
            
            $stmt ->execute([
                ':ho_ten'=>$ho_ten,
                ':email'=>$email,
                ':so_dien_thoai'=>$so_dien_thoai,
                ':trang_thai'=>$trang_thai,
                ':id'=>$id
                
            ]);
            
            return true;

        } catch (Exception $e) {
            echo 'lỗi ' .$e->getMessage();
        }
    }
    public function UpdateKhachHang(
        $id,
        $ho_ten,
        $email,
        $so_dien_thoai,
        $ngay_sinh,
        $gioi_tinh,
        $dia_chi,
        $trang_thai){
            try {
                $sql = 'UPDATE tai_khoans  SET 
                ho_ten = :ho_ten,
                email=:email,
                so_dien_thoai=:so_dien_thoai,
                ngay_sinh=:ngay_sinh,
                gioi_tinh=:gioi_tinh,
                dia_chi=:dia_chi,
                trang_thai=:trang_thai
                
                where id = :id';            
                $stmt = $this->conn->prepare($sql);
                
                $stmt ->execute([
                    ':ho_ten'=>$ho_ten,
                    ':email'=>$email,
                    ':so_dien_thoai'=>$so_dien_thoai,
                    ':ngay_sinh'=>$ngay_sinh,
                    ':gioi_tinh'=>$gioi_tinh,
                    ':dia_chi'=>$dia_chi,
                    ':trang_thai'=>$trang_thai,
                    ':id'=>$id
                    
                ]);
                
                return true;
    
            } catch (Exception $e) {
                echo 'lỗi ' .$e->getMessage();
            }
        }
        public function deleteKhachHang($id_khach_hang)
        {
            try {
                // Tạo câu lệnh SQL để xóa tài khoản theo id
                $sql = 'DELETE FROM tai_khoans WHERE id = :id_khach_hang';
                $stmt = $this->conn->prepare($sql);
    
                // Thực thi câu lệnh SQL
                $stmt->execute([':id_khach_hang' => $id_khach_hang]);
    
                // Kiểm tra xem có bị ảnh hưởng dòng nào không
                return $stmt->rowCount() > 0;
            } catch (Exception $e) {
                error_log('Lỗi khi xóa tài khoản: ' . $e->getMessage());
                return false; // Nếu có lỗi, trả về false
            }
        }
        public function checkLogin($email, $mat_khau){
            try{
                $sql="SELECT * FROM tai_khoans WHERE email = :email";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute(['email'=>$email]);
                $user = $stmt->fetch();
    
                if($user && password_verify($mat_khau,$user['mat_khau'])){
                    if($user['chuc_vu'] == 1){
                        if($user['trang_thai'] == 1){
                            return $user['email']; //dang nhap thanh cong
                        }else{
                            return "Tài khoản bị cấm!";
                        }
                      }else{
                    return "Tài khoản không có quyền đăng nhập!"; 
                }
                }else{
                    return "Bạn nhập sai tài khoản hoặc mật khẩu!";
                }
            }catch(\Exception $e){
                echo "Lỗi!" . $e->getMessage();
                return false;
            }
        }
}
