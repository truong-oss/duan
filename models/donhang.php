<?php

class DonHang{

    public $conn;
    public function __construct(){
        $this->conn = connectDB();
    }
    public function getDetailDonHang($id) {
        try {
            $sql = 'SELECT don_hangs.*, trang_thai_don_hangs.ten_trang_thai, tai_khoans.ho_ten, tai_khoans.email, tai_khoans.so_dien_thoai, trang_thai_thanh_toans.ten_trang_thais, thanh_toans.ten_hinh_thuc
                    FROM don_hangs 
                    INNER JOIN trang_thai_don_hangs ON don_hangs.trang_thai_don_hang_id = trang_thai_don_hangs.id
                    INNER JOIN tai_khoans ON don_hangs.tai_khoan_id = tai_khoans.id
                    INNER JOIN trang_thai_thanh_toans ON don_hangs.trang_thai_thanh_toan_id = trang_thai_thanh_toans.id
                    INNER JOIN thanh_toans ON don_hangs.phuong_thuc_thanh_toan_id = thanh_toans.id
                    WHERE don_hangs.id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }

    public function getListSpDonHang($id) {
        try {
            $sql = 'SELECT chi_tiet_don_hangs.*, 
                           san_phams.ten_san_pham, 
                           san_phams.mo_ta, 
                           san_phams.hinh_anh, 
                           trang_thai_don_hangs.ten_trang_thai,
                           trang_thai_thanh_toans.ten_trang_thais,
                           thanh_toans.ten_hinh_thuc
                    FROM chi_tiet_don_hangs
                    INNER JOIN san_phams ON chi_tiet_don_hangs.san_pham_id = san_phams.id
                    INNER JOIN don_hangs ON chi_tiet_don_hangs.don_hang_id = don_hangs.id
                    INNER JOIN trang_thai_don_hangs ON don_hangs.trang_thai_don_hang_id = trang_thai_don_hangs.id
                    INNER JOIN thanh_toans ON don_hangs.phuong_thuc_thanh_toan_id = thanh_toans.id
                    INNER JOIN trang_thai_thanh_toans ON don_hangs.trang_thai_thanh_toan_id = trang_thai_thanh_toans.id
                    WHERE chi_tiet_don_hangs.don_hang_id = :id';
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }
   
    public function getAllTrangThaiDonHang() {
        try {
            $sql = 'SELECT * FROM trang_thai_don_hangs';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }

    public function getAllDonhang() {
        $sql = "SELECT * FROM don_hangs ORDER BY id DESC"; // Sắp xếp theo ngày đặt giảm dần
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    // Lấy đơn hàng theo tài khoản người dùng
    public function getAlldonhangByUser($tai_khoan_id) {
        try {
            $sql = 'SELECT don_hangs.*
                    FROM don_hangs
                    WHERE tai_khoan_id = :tai_khoan_id
                    ORDER BY id DESC'; // Sắp xếp theo ngày đặt giảm dần
    
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':tai_khoan_id' => $tai_khoan_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return [];
        }
    }
    

public function getTaiKhoanFormEmail($email)
{
    try {
        $sql = 'SELECT * FROM tai_khoans WHERE email = :email';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        $result = $stmt->fetch();
        if (!$result) {
            throw new Exception("Không tìm thấy tài khoản với email: $email");
        }
        return $result;
    } catch (Exception $e) {
        // In lỗi để gỡ lỗi
        echo 'Lỗi: ' . $e->getMessage();
        return null;
    }
}

    public function getIDDonHang($id) {
        $query = "SELECT * from don_hangs 
        WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $donHang = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($donHang) {
                return $donHang; 
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function updateTrangThaiDonHang($id_don_hang) {
        try {
            $sql = 'UPDATE don_hangs SET trang_thai_don_hang_id = :trang_thai WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            
            // Trạng thái mới là 10
            $trang_thai_moi = 10;
    
            $stmt->execute([
                ':trang_thai' => $trang_thai_moi,
                ':id' => $id_don_hang
            ]);
    
            return $stmt->rowCount() > 0;
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
    
    
}