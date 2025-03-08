<?php
class AdminDanhMuc{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllDanhMuc(){
        try{
        $sql = 'select *from danh_mucs';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
        }catch(Exception $e){
            echo "lỗi" .$e->getMessage();
        }
       
    }
    public function addDanhMuc($ten_danh_muc,$mo_to){
        try{
        $sql = 'insert into danh_mucs(ten_danh_muc,mo_ta) values(:ten_danh_muc,:mo_ta)';
        $stmt =$this->conn->prepare($sql);
        $stmt->execute([
            ':ten_danh_muc' =>$ten_danh_muc,
            ':mo_ta' =>$mo_to
        ]);
        }catch(Exception $e){
            echo "lỗi" .$e->getMessage();
        }
    }
    public function getDetailDanhMuc($id){
        try{
            $sql ='select * from danh_mucs where id =:id';
            $stmt =$this->conn->prepare($sql);
            $stmt->execute([
                'id'=>$id
            ]);
            return $stmt->fetch();
        }catch(Exception $e){
            echo "lỗi" .$e->getMessage();
        }
    }
    public function updateDanhMuc($id,$ten_danh_muc,$mo_to){
        try{
            $sql ='update danh_mucs set ten_danh_muc =:ten_danh_muc,mo_ta=:mo_ta WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'id'=>$id,
                'ten_danh_muc'=>$ten_danh_muc,
                'mo_ta'=>$mo_to
            ]);
            return true;
        }catch(Exception $e){
            echo "lỗi" .$e->getMessage();
        }
    }
    public function deleteDMuc($id){
        try{
            $sql ='delete from danh_mucs where id =:id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'id'=>$id
            ]);
            return true;
        }catch(Exception $e){
            echo "lỗi" .$e->getMessage();
        }
    }
}
?>