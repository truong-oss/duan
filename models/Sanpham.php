<?php 

class Sanpham 
{
    public  $conn;
    
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllSanPham(){
        try {
            $sql = 'SELECT san_phams .*,danh_mucs.ten_danh_muc
            from san_phams
            INNER JOIN danh_mucs on san_phams.danh_muc_id = danh_mucs.id';
            $stmt = $this->conn->prepare($sql);
            $stmt-> execute();
            return $stmt->fetchAll();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function getAllDanhmuc(){
        try {
            $sql = 'SELECT * from danh_mucs 
            ';
            $stmt = $this->conn->prepare($sql);
            $stmt-> execute();
            return $stmt->fetchAll();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function getOnesp($id){
        try {
            $sql = 'SELECT san_phams .*,danh_mucs.ten_danh_muc
            from san_phams
            INNER JOIN danh_mucs on san_phams.danh_muc_id = danh_mucs.id
            where san_phams.id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt-> execute([':id'=>$id]);
            return $stmt->fetch();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getListAnhsp($id){
        try {
            $sql = 'SELECT * from list_anh_san_phams where san_pham_id=:id';
            $stmt = $this->conn->prepare($sql);
            $stmt-> execute([':id'=>$id]);
            return $stmt->fetchAll();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getSanphamTheodanhmuc($danh_muc_id){
        try {
            $sql = 'SELECT san_phams .*,danh_mucs.ten_danh_muc
            from san_phams
            INNER JOIN danh_mucs on san_phams.danh_muc_id = danh_mucs.id
            where san_phams.danh_muc_id= '.$danh_muc_id;
            $stmt = $this->conn->prepare($sql);
            $stmt-> execute();
            return $stmt->fetchAll();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getBinhLuanSanPham($id) {
        try {
            $sql = "SELECT binh_luans.*, tai_khoans.ho_ten
                    FROM binh_luans
                    INNER JOIN tai_khoans ON binh_luans.tai_khoan_id = tai_khoans.id
                    WHERE binh_luans.san_pham_id = :id AND binh_luans.trang_thai = 1
                     ORDER BY binh_luans.id DESC"; // Thêm điều kiện trạng thái = 1
    
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    
    public function getaddbinhluan($tai_khoan_id, $san_pham_id, $noi_dung, $ngay_dang, $trang_thai) {
        try {
            $sql = 'INSERT INTO binh_luans (tai_khoan_id, san_pham_id, noi_dung, ngay_dang, trang_thai) 
                    VALUES (:tai_khoan_id, :san_pham_id, :noi_dung, :ngay_dang, :trang_thai)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':tai_khoan_id' => $tai_khoan_id,
                ':san_pham_id' => $san_pham_id,
                ':noi_dung' => $noi_dung,
                ':ngay_dang' => $ngay_dang,
                ':trang_thai' => $trang_thai
            ]);
    
            // Kiểm tra số bản ghi bị ảnh hưởng
            if ($stmt->rowCount() > 0) {
                return true; // Thành công
            }
            return false; // Không có bản ghi bị ảnh hưởng
        } catch (\Throwable $th) {
            // Ghi lỗi vào log
            error_log("Lỗi khi thêm bình luận: " . $th->getMessage());
            // Ném lỗi ra ngoài
            throw new Exception("Không thể thêm bình luận, vui lòng thử lại sau.");
        }
    }
    
    public function timKiemSanPham($keyword) {
        try {
            $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc
                    FROM san_phams
                    INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
                    WHERE san_phams.ten_san_pham LIKE :keyword';
                    
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':keyword' => '%' . $keyword . '%']);
            
            return $stmt->fetchAll();
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return [];
        }

    }
    public function getListBanner(){
        try {
            $sql= "select *from banners where trang_thai_id=1";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function getSanphamByDanhMuc($danh_muc_id) {
        try {
            $query = 'SELECT san_phams.*, danh_mucs.ten_danh_muc 
                      FROM san_phams 
                      INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id 
                      WHERE san_phams.danh_muc_id = :danh_muc_id';
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':danh_muc_id', $danh_muc_id, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll();
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return []; 
        }
    }

}