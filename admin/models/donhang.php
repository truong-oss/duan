<?php

class AdminDonHang{

    public $conn;
    public function __construct(){
        $this->conn = connectDB();
    }
    public function getAlldonhang(){
        try {
            $sql = 'SELECT don_hangs.*, trang_thai_don_hangs.ten_trang_thai ,trang_thai_thanh_toans.ten_trang_thais
            FROM don_hangs
            INNER JOIN trang_thai_don_hangs ON don_hangs.trang_thai_don_hang_id = trang_thai_don_hangs.id
            INNER JOIN trang_thai_thanh_toans ON don_hangs.trang_thai_thanh_toan_id = trang_thai_thanh_toans.id
           ;';
            $stmt = $this->conn->prepare($sql);
            $stmt ->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo 'lỗi' .$e->getMessage();
        }
    }

    public function  getDetailDonHang($id) {
        try {
            $sql = 'SELECT don_hangs.*, trang_thai_don_hangs.ten_trang_thai,  trang_thai_thanh_toans.ten_trang_thais,thanh_toans.ten_hinh_thuc
                    FROM don_hangs 
                    INNER JOIN trang_thai_don_hangs ON don_hangs.trang_thai_don_hang_id = trang_thai_don_hangs.id
                    INNER JOIN trang_thai_thanh_toans ON don_hangs.trang_thai_thanh_toan_id = trang_thai_thanh_toans.id
                    INNER JOIN thanh_toans ON don_hangs.phuong_thuc_thanh_toan_id = thanh_toans.id
                    WHERE don_hangs.id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id'=>$id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function getListSpDonHang($id){
        try {
            $sql = 'SELECT chi_tiet_don_hangs.*,san_phams.ten_san_pham,san_phams.mo_ta
            from chi_tiet_don_hangs
            INNER JOIN san_phams on chi_tiet_don_hangs.san_pham_id = san_phams.id
            where chi_tiet_don_hangs.don_hang_id = :id';
             $stmt = $this->conn->prepare($sql);
             $stmt->execute([':id' => $id]);
             return $stmt->fetchAll();
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
    }

    public function getAllTrangThaiDonHang(){
        try {
            $sql ='SELECT * from trang_thai_don_hangs';
            // var_dump($sql);
             $stmt = $this->conn->prepare($sql);
             $stmt->execute();
             return $stmt->fetchAll();
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
    }
    public function getAllTrangThaithanhtoan(){
        try {
            $sql ='SELECT * from trang_thai_thanh_toans';
                 $stmt = $this->conn->prepare($sql);
             $stmt->execute();
             return $stmt->fetchAll();
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
    }
    public function updateDonHang($id,
    $trang_thai_don_hang_id,
    $trang_thai_thanh_toan_id){
        try {
            $sql = 'UPDATE don_hangs
                set
                trang_thai_don_hang_id = :trang_thai_don_hang_id,
                trang_thai_thanh_toan_id = :trang_thai_thanh_toan_id
                where id = :id';    
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':trang_thai_don_hang_id' => $trang_thai_don_hang_id,
                ':trang_thai_thanh_toan_id' => $trang_thai_thanh_toan_id,
                ':id' => $id
            ]);
            return true;
        }catch (Exception $e){
            echo "lỗi" .$e->getMessage();
        }
    }
    public function getDonHangFromKhachHang($id) {
        try {
            $sql = 'SELECT  don_hangs.*, trang_thai_don_hangs.ten_trang_thai 
                    FROM don_hangs 
                    INNER JOIN trang_thai_don_hangs ON don_hangs.trang_thai_don_hang_id = trang_thai_don_hangs.id
            where don_hangs.tai_khoan_id=:id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id'=>$id]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }
}