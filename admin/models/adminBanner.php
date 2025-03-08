<?php
class AdminBanner{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function listbanner(){
        try {
            $sql = 'SELECT banners.*, trang_thai_banner.trang_thai_banner
            from banners
            INNER JOIN trang_thai_banner on banners.trang_thai_id = trang_thai_banner.id';
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Throwable $th) {
            echo "lỗi";
        }
    }

    public function InsertBanner($mo_ta,$ngay_dang,$trang_thai_id, $link_anh){
        try {
            $sql = 'INSERT INTO banners (mo_ta,ngay_dang,trang_thai_id,link_anh)
            values (:mo_ta, :ngay_dang,:trang_thai_id, :link_anh)';
            $stmt=$this->conn->prepare($sql);
            $stmt->execute([':mo_ta'=>$mo_ta,':ngay_dang'=>$ngay_dang,':trang_thai_id'=>$trang_thai_id,':link_anh'=>$link_anh]);
            return $this->conn->lastInsertId();
        }  catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }


    public function getIDBanner($id){
        try {
            $sql = 'SELECT * from banners where id=:id';
            $stmt=$this->conn->prepare($sql);
            $stmt->execute([':id'=>$id]);
            return $stmt->fetch();
        } catch (\Throwable $th) {
            echo "lỗi";
        }
    }
    public function DeleteBanner($id){
        try {
            $sql = 'DELETE from banners where id=:id';
            $stmt=$this->conn->prepare($sql);
            $stmt->execute([':id'=>$id]);
            return true;
        } catch (\Throwable $th) {
            echo "lỗi";
        }
    }
    public function UpdateBanner($id,$mo_ta,$ngay_dang,$trang_thai_id, $link_anh){
        try {
            $sql = 'UPDATE banners set mo_ta = :mo_ta,
            ngay_dang = :ngay_dang,
            trang_thai_id = :trang_thai_id,
            link_anh = :link_anh
            where id=:id';
            $stmt=$this->conn->prepare($sql);
            $stmt->execute([':id'=>$id,
            ':mo_ta'=>$mo_ta,
            ':ngay_dang'=>$ngay_dang,
            ':trang_thai_id'=>$trang_thai_id,
            ':link_anh'=>$link_anh]);
            return true;
        } catch (\Throwable $th) {
            echo "lỗi";
        }
    }

    public function updateTrangThaiBanner($id, $trang_thai_id){
        try {
            $sql = 'UPDATE banners set trang_thai_id=:trang_thai_id where id=:id';
            $stmt=$this->conn->prepare($sql);
            $stmt->execute([':id'=>$id,
            ':trang_thai_id'=>$trang_thai_id
            ]);
            return true;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    }
    
?>