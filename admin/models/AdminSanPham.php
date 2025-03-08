<?php
class AdminSanPham{
    public $conn;
    public function __construct()
    {
        $this->conn=connectDB();
    }
    public function getAllSanPham(){
        try {
            $sql = "SELECT san_phams.*, danh_mucs.ten_danh_muc
            from san_phams
            inner join danh_mucs on san_phams.danh_muc_id = danh_mucs.id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }catch (Exception $e){
            echo "lỗi" .$e->getMessage();
        }
    }

    public function insertSanPham($ten_san_pham,$gia_san_pham,$gia_khuyen_mai,$so_luong,$ngay_nhap,$danh_muc_id,$trang_thai,$mo_ta,$hinh_anh){
        try {
            $sql = 'insert into san_phams (ten_san_pham, gia_san_pham, gia_khuyen_mai, so_luong, ngay_nhap, danh_muc_id, trang_thai, mo_ta, hinh_anh)
                    values (:ten_san_pham, :gia_san_pham, :gia_khuyen_mai, :so_luong, :ngay_nhap, :danh_muc_id, :trang_thai, :mo_ta, :hinh_anh)';

                  
            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':ten_san_pham' => $ten_san_pham,
                ':gia_san_pham' => $gia_san_pham,
                ':gia_khuyen_mai' => $gia_khuyen_mai,
                ':so_luong' => $so_luong,
                ':ngay_nhap' => $ngay_nhap,
                ':danh_muc_id' => $danh_muc_id,
                ':trang_thai' => $trang_thai,
                ':mo_ta' => $mo_ta,
                ':hinh_anh' => $hinh_anh,
            ]);
           
       
            return $this->conn->lastInsertId();
        }catch (Exception $e){
            echo "lỗi" .$e->getMessage();
        }
    }
   
    public function insertAlbumAnhSanPham($san_pham_id,$link_hinh_anh){
        try {
            $sql = 'insert into list_anh_san_phams (san_pham_id, link_hinh_anh)
                    values (:san_pham_id, :link_hinh_anh)';
            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':san_pham_id' => $san_pham_id,
                ':link_hinh_anh' => $link_hinh_anh,
                
            ]);
            //lấy id sản phẩm vừa thêm
            return true;
        }catch (Exception $e){
            echo "lỗi" .$e->getMessage();
        }
    }
     public function getDetailSanPham($id){
        try {
            $sql = "SELECT  san_phams.*, danh_mucs.ten_danh_muc
            from san_phams
            inner join danh_mucs on san_phams.danh_muc_id = danh_mucs.id
            where san_phams.id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        }catch (Exception $e){
            echo "lỗi" .$e->getMessage();
        }
     }

     public function getListAnhSanPham($id){
        try {
            $sql = "SELECT *FROM list_anh_san_phams where san_pham_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetchAll();
        }catch (Exception $e){
            echo "lỗi" .$e->getMessage();
        }
     }

     public function updateSanPham($san_pham_id,$ten_san_pham,$gia_san_pham,$gia_khuyen_mai,$so_luong,$ngay_nhap,$danh_muc_id,$trang_thai,$mo_ta,$hinh_anh){
        try {
            $sql = 'update san_phams
                set
                ten_san_pham = :ten_san_pham,
                gia_san_pham = :gia_san_pham,
                gia_khuyen_mai = :gia_khuyen_mai,
                so_luong = :so_luong,
                ngay_nhap = :ngay_nhap,
                danh_muc_id = :danh_muc_id,
                trang_thai = :trang_thai,
                mo_ta = :mo_ta,
                hinh_anh = :hinh_anh
                where id = :id';
            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':ten_san_pham' => $ten_san_pham,
                ':gia_san_pham' => $gia_san_pham,
                ':gia_khuyen_mai' => $gia_khuyen_mai,
                ':so_luong' => $so_luong,
                ':ngay_nhap' => $ngay_nhap,
                ':danh_muc_id' => $danh_muc_id,
                ':trang_thai' => $trang_thai,
                ':mo_ta' => $mo_ta,
                ':hinh_anh' => $hinh_anh,
                ':id' => $san_pham_id,
            ]);
            
            return true;
        }catch (Exception $e){
            echo "lỗi" .$e->getMessage();
        }
    }

    public function getDetailAnhSanPham($id){
        try {
            $sql = "SELECT *FROM list_anh_san_phams where id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        }catch (Exception $e){
            echo "lỗi" .$e->getMessage();
        }
     }

     public function updateAnhSanPham($id,$new_file){
        try {
            $sql = 'update list_anh_san_phams
                set
                link_hinh_anh = :new_file
                
                
                where id = :id';
               
            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':new_file' => $new_file,
                ':id' => $id
                
            ]);
           
            return true;
        }catch (Exception $e){
            echo "lỗi" .$e->getMessage();
        }
    }

    public function destroyAnhSanPham($id) {
        try {
            $sql = 'DELETE FROM list_anh_san_phams WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
    
            $stmt->execute([':id' => $id]);
    
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }
    public function destroySanPham($id) {
        try {
            $sql = 'DELETE FROM san_phams WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
    
            $stmt->execute([':id' => $id]);
    
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    
    
    public function getBinhLuanFromKhachHang($id){
        try {
            $sql = "SELECT binh_luans.*, san_phams.ten_san_pham
            from binh_luans
            inner join san_phams on binh_luans.san_pham_id = san_phams.id
            where binh_luans.tai_khoan_id = :id
            ";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetchAll();
        }catch (Exception $e){
            echo "lỗi" .$e->getMessage();
        }
    }

    public function getDetailBinhLuan($id){
        try {
            $sql = "SELECT *FROM binh_luans where id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        }catch (Exception $e){
            echo "lỗi" .$e->getMessage();
        }
     }

     public function updateTrangThaiBinhLuan($id,$trang_thai){
        try {
            $sql = 'update binh_luans
                set
                trang_thai = :trang_thai
               
                where id = :id';
            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                
                ':trang_thai' => $trang_thai,
                ':id' => $id,
            ]);
            //lấy id sản phẩm vừa thêm
            return true;
        }catch (Exception $e){
            echo "lỗi" .$e->getMessage();
        }
    }

    public function getBinhLuanFromSanPham($id){
        try {
            $sql = "SELECT binh_luans.*, tai_khoans.ho_ten
            from binh_luans
            inner join tai_khoans on binh_luans.tai_khoan_id = tai_khoans.id
            where binh_luans.san_pham_id = :id
            ";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetchAll();
        }catch (Exception $e){
            echo "lỗi" .$e->getMessage();
        }
    }
}