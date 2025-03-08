<?php

class Thanhtoan
{
    public  $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getGioHangFormId($tai_khoan_id = null, $session_id = null)
    {
        try {
            if ($tai_khoan_id) {
                $sql = 'SELECT * FROM gio_hangs WHERE tai_khoan_id = :tai_khoan_id';
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([':tai_khoan_id' => $tai_khoan_id]);
            } else {
                $sql = 'SELECT * FROM gio_hangs WHERE session_id = :session_id';
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([':session_id' => $session_id]);
            }
            
            return $stmt->fetch();
        } catch (Exception $e) {
            echo 'lỗi' . $e->getMessage();
        }
    }
    

    public function AddGioHang($tai_khoan_id , $session_id)
{
    try {
        // Nếu người dùng đã đăng nhập, sử dụng tai_khoan_id, nếu không sử dụng session_id
        if ($tai_khoan_id) {
            $sql = 'INSERT INTO gio_hangs (tai_khoan_id) VALUES (:tai_khoan_id)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':tai_khoan_id' => $tai_khoan_id]);
        } else {
            $sql = 'INSERT INTO gio_hangs (session_id) VALUES (:session_id)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':session_id' => $session_id]);
        }

        return $this->conn->lastInsertId();
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}


    public function getDetailGioHang($id)
    {
        try {
            $sql = 'SELECT 
            chi_tiet_gio_hangs.*, 
            san_phams.ten_san_pham, 
            san_phams.hinh_anh, 
            san_phams.gia_san_pham, 
            san_phams.gia_khuyen_mai
        FROM 
            chi_tiet_gio_hangs
        INNER JOIN 
            san_phams 
        ON 
            chi_tiet_gio_hangs.san_pham_id = san_phams.id
        WHERE 
            chi_tiet_gio_hangs.gio_hang_id = :gio_hang_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':gio_hang_id' => $id]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo 'lỗi' . $e->getMessage();
        }
    }

    public function getTaiKhoanFormEmail($email)
    {
        try {
            // Kiểm tra email hợp lệ
            if (!is_string($email) || empty($email)) {
                throw new Exception("Email không hợp lệ.");
            }
    
            // Chuẩn bị câu lệnh SQL
            $sql = 'SELECT * FROM tai_khoans WHERE email = :email';
            $stmt = $this->conn->prepare($sql);
    
            // Thực thi câu lệnh với tham số
            $stmt->execute([':email' => $email]);
            $result = $stmt->fetch();
    
            // Kiểm tra nếu không tìm thấy kết quả
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
    
    
    public function addDonHang(
        $tai_khoan_id,
        $ten_nguoi_nhan,
        $email_nguoi_nhan,
        $sdt_nguoi_Nhan,
        $dia_chi_nguoi_nhan,
        $ghi_chu,
        $tong_tien,
        $ngay_dat,
        $phuong_thuc_thanh_toan_id,
        $ma_don_hang,
        $trang_thai_don_hang_id,
        $trang_thai_thanh_toan_id
    ) {
        try {
            $sql = 'INSERT INTO don_hangs (
                tai_khoan_id,
                ten_nguoi_nhan,
                email_nguoi_nhan,
                sdt_nguoi_Nhan,
                dia_chi_nguoi_nhan,
                ghi_chu,
                tong_tien,
                ngay_dat,
                phuong_thuc_thanh_toan_id,
                ma_don_hang,
                trang_thai_don_hang_id,
                trang_thai_thanh_toan_id
            ) VALUES (
                :tai_khoan_id,
                :ten_nguoi_nhan,
                :email_nguoi_nhan,
                :sdt_nguoi_Nhan,
                :dia_chi_nguoi_nhan,
                :ghi_chu,
                :tong_tien,
                :ngay_dat,
                :phuong_thuc_thanh_toan_id,
                :ma_don_hang,
                :trang_thai_don_hang_id,
                :trang_thai_thanh_toan_id
            )';
   
            $stmt = $this->conn->prepare($sql);
            $result = $stmt->execute([
                ':tai_khoan_id' => $tai_khoan_id,
                ':ten_nguoi_nhan' => $ten_nguoi_nhan,
                ':email_nguoi_nhan' => $email_nguoi_nhan,
                ':sdt_nguoi_Nhan' => $sdt_nguoi_Nhan,
                ':dia_chi_nguoi_nhan' => $dia_chi_nguoi_nhan,
                ':ghi_chu' => $ghi_chu,
                ':tong_tien' => $tong_tien,
                ':ngay_dat' => $ngay_dat,
                ':phuong_thuc_thanh_toan_id' => $phuong_thuc_thanh_toan_id,
                ':ma_don_hang' => $ma_don_hang,
                ':trang_thai_don_hang_id' => $trang_thai_don_hang_id,
                ':trang_thai_thanh_toan_id' => $trang_thai_thanh_toan_id
            ]);
   
            // Kiểm tra kết quả của execute() để xem có lỗi không
            if ($result) {
                return $this->conn->lastInsertId();
            } else {
                echo 'Lỗi khi thêm đơn hàng!';
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function addChiTietDonHang($don_hang_id, $san_pham_id, $so_luong, $don_gia,$thanh_tien) {
        $sql = "INSERT INTO chi_tiet_don_hangs (don_hang_id, san_pham_id, so_luong, don_gia,thanh_tien)
                VALUES (:don_hang_id, :san_pham_id, :so_luong, :don_gia,:thanh_tien)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':don_hang_id' => $don_hang_id,
            ':san_pham_id' => $san_pham_id,
            ':so_luong' => $so_luong,
            ':don_gia' => $don_gia,
            ':thanh_tien' => $thanh_tien
        ]);
    }
        
        public function clearGioHang($gio_hang_id) {
            try {
                // Xóa chi tiết giỏ hàng trước
                $sql1 = 'DELETE FROM chi_tiet_gio_hangs WHERE gio_hang_id = :gio_hang_id';
                $stmt1 = $this->conn->prepare($sql1);
                $stmt1->execute([':gio_hang_id' => $gio_hang_id]);
        
                // Sau đó xóa giỏ hàng
                $sql2 = 'DELETE FROM gio_hangs WHERE id = :gio_hang_id';
                $stmt2 = $this->conn->prepare($sql2);
                $stmt2->execute([':gio_hang_id' => $gio_hang_id]);
        
                // Trả về true nếu thành công
                return true;
            } catch (Exception $e) {
                // In ra lỗi nếu có
                echo 'Error: ' . $e->getMessage();
                return false;
            }
        }
        
}
