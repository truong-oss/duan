<?php
class Taikhoan{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
  
    public function checklogin($email, $mat_khau) {
        try {
            $sql = 'SELECT id, email,ho_ten, mat_khau, chuc_vu, trang_thai FROM tai_khoans WHERE email = :email';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'email' => $email
            ]);
            $user = $stmt->fetch();
    
            if ($user && password_verify($mat_khau, $user['mat_khau'])) {
                if ($user['chuc_vu'] == 2) {  // Kiểm tra quyền truy cập
                    if ($user['trang_thai'] == 1) {  // Kiểm tra trạng thái tài khoản
                        return $user;  // Trả về toàn bộ thông tin người dùng
                    } else {
                        return "Tài khoản bị cấm";
                    }
                } else {
                    return "Tài khoản không có quyền đăng nhập";
                }
            } else {
                return "Bạn nhập sai thông tin mật khẩu hoặc tài khoản";
            }
        } catch (\Throwable $th) {
            // Xử lý lỗi nếu cần
        }
    }
    
    public function addtkkhachhang($ho_ten,$email,$so_dien_thoai,$mat_khau,$chuc_vu){
        try {
        $sql = 'insert into tai_khoans (ho_ten,email,so_dien_thoai,mat_khau,chuc_vu) values(:ho_ten,:email,:so_dien_thoai,:mat_khau,:chuc_vu)';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':ho_ten' =>$ho_ten,
            ':email' =>$email,
            ':mat_khau'=>$mat_khau,
            ':so_dien_thoai'=>$so_dien_thoai,
            ':chuc_vu'=>$chuc_vu
        ]);
        return true;
        } catch (\Throwable $th) {
            error_log("Error in addtkkhachhang: " . $th->getMessage());
            return false;
        }
    }
    // check email trung lập 
    public function checkmail($email){
        try {
            $sql ='select * from tai_khoans where email =:email';
            $stmt=$this->conn->prepare($sql);
            $stmt->execute([
                ':email' => $email
            ]);
            return $stmt->fetch();
        } catch (\Throwable $th) {
            error_log("Error in addtkkhachhang: " . $th->getMessage());
            return false;
        }
    }
    // quản lý tài khoản cá nhân
    public function getuser($user_id){
       try {
        $sql = "select * from tai_khoans where id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id'=>$user_id]);
        return $stmt->fetch();
       } catch (\Throwable $th) {
        echo "lỗi";
       }
    }
    public function updateTaiKhoan($user_id, $ho_ten, $email, $so_dien_thoai, $gioi_tinh, $dia_chi, $file_thumb)
    {
        try {
            // Cập nhật thông tin tài khoản
            $sql = 'UPDATE tai_khoans 
                    SET ho_ten = :ho_ten, email = :email, so_dien_thoai = :so_dien_thoai, 
                        gioi_tinh = :gioi_tinh, dia_chi = :dia_chi, anh_dai_dien = :anh_dai_dien
                    WHERE id = :id';
            
            $stmt = $this->conn->prepare($sql);
    
            // Thực thi câu lệnh SQL với các tham số
            $stmt->execute([
                ':ho_ten' => $ho_ten,
                ':email' => $email,
                ':so_dien_thoai' => $so_dien_thoai,
                ':gioi_tinh' => $gioi_tinh,
                ':dia_chi' => $dia_chi,
                ':anh_dai_dien' => $file_thumb,
                ':id' => $user_id
            ]);
    
        } catch (\Throwable $th) {
            // Xử lý lỗi nếu có
            echo "Lỗi cập nhật: " . $th->getMessage();
        }
    }
    //
    public function getPasswordById($user_id)
    {
        try {
            $sql = 'SELECT mat_khau FROM tai_khoans WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $user_id]);
            return $stmt->fetchColumn();  // Trả về mật khẩu, không phải mảng
        } catch (PDOException $e) {
            echo "Lỗi lấy mật khẩu: " . $e->getMessage();
            return null;
        }
    }
    

public function updatePassword($user_id, $new_password)
{
    try {
        $sql = 'UPDATE tai_khoans SET mat_khau = :new_password WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':new_password' => $new_password,
            ':id' => $user_id
        ]);
    } catch (PDOException $e) {
        echo "Lỗi cập nhật mật khẩu: " . $e->getMessage();
    }
}

} 
?>