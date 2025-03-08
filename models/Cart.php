<?php
class Cart
{
   
    public $conn;

    public function __construct()
    {
      $this->conn = connectDB();
    }
  
    public function getGioHangFromUser($id)
    {
      try {
        $sql = "SELECT * FROM gio_hangs WHERE tai_khoan_id = :tai_khoan_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(
          [
            ':tai_khoan_id' => $id
          ]
        );
        return $stmt->fetch();
      } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
      }
    }
  
    public function getGioHangBySessionId($session_id) {
      // Truy vấn cơ sở dữ liệu để lấy giỏ hàng dựa trên session_id
      $sql = "SELECT * FROM gio_hangs WHERE session_id = :session_id";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':session_id', $session_id, PDO::PARAM_STR);
      $stmt->execute();

      // Nếu có kết quả, trả về giỏ hàng
      return $stmt->fetch(PDO::FETCH_ASSOC);
  }
  public function getDetailGioHang($gioHangId) {
    $sql = "SELECT  chi_tiet_gio_hangs .*, san_phams.ten_san_pham,san_phams.gia_khuyen_mai,san_phams.hinh_anh
    from chi_tiet_gio_hangs
    INNER JOIN san_phams on chi_tiet_gio_hangs.san_pham_id = san_phams.id WHERE gio_hang_id = :gio_hang_id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([':gio_hang_id'=> $gioHangId]);
    return $stmt->fetchAll();
}
  
public function addGioHang($tai_khoan_id = null, $session_id = null) {
    // Kiểm tra nếu tai_khoan_id có giá trị, dùng tai_khoan_id, nếu không dùng session_id
    // Kiểm tra giỏ hàng đã tồn tại
    if ($tai_khoan_id) {
        // Nếu người dùng đã đăng nhập, kiểm tra giỏ hàng
        $sql = "SELECT * FROM gio_hangs WHERE tai_khoan_id = :tai_khoan_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':tai_khoan_id' => $tai_khoan_id]);
        $gioHang = $stmt->fetch();

        if ($gioHang) {
            return $gioHang['id']; // Trả về ID giỏ hàng đã có
        } else {
            // Nếu không có giỏ hàng, tạo mới
            $sql = "INSERT INTO gio_hangs (tai_khoan_id) VALUES (:tai_khoan_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':tai_khoan_id' => $tai_khoan_id]);
            return $this->conn->lastInsertId(); // Lấy ID giỏ hàng mới vừa thêm
        }
    } else {
        // Nếu người dùng chưa đăng nhập, kiểm tra giỏ hàng theo session_id
        $sql = "SELECT * FROM gio_hangs WHERE session_id = :session_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':session_id' => $session_id]);
        $gioHang = $stmt->fetch();

        if ($gioHang) {
            return $gioHang['id']; // Trả về ID giỏ hàng đã có
        } else {
            // Nếu không có giỏ hàng, tạo mới
            $sql = "INSERT INTO gio_hangs (session_id) VALUES (:session_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':session_id' => $session_id]);
            return $this->conn->lastInsertId(); // Lấy ID giỏ hàng mới vừa thêm
        }
    }
}

    public function updateSoLuong($gio_hang_id, $san_pham_id, $so_luong) {
      try {
          $sql = "UPDATE chi_tiet_gio_hangs 
                  SET so_luong = :so_luong 
                  WHERE gio_hang_id = :gio_hang_id 
                  AND san_pham_id = :san_pham_id";
          $stmt = $this->conn->prepare($sql);
          $stmt->execute([
              ':gio_hang_id' => $gio_hang_id,
              ':san_pham_id' => $san_pham_id,
              ':so_luong' => $so_luong,
          ]);
          return true;
      } catch (Exception $e) {
          echo "Lỗi: " . $e->getMessage();
          return false;
      }
    }
    public function deleteSanPhamGioHang($gio_hang_id, $san_pham_id) {
      try {
          $sql = "DELETE FROM chi_tiet_gio_hangs 
                  WHERE gio_hang_id = :gio_hang_id 
                  AND san_pham_id = :san_pham_id";
          $stmt = $this->conn->prepare($sql);
          $stmt->execute([
              ':gio_hang_id' => $gio_hang_id,
              ':san_pham_id' => $san_pham_id,
          ]);
          return true;
      } catch (Exception $e) {
          echo "Lỗi: " . $e->getMessage();
          return false;
      }
    }

  
    public function addDetailGioHang($gio_hang_id, $san_pham_id, $so_luong)
    {
      try {
        $sql = "INSERT INTO chi_tiet_gio_hangs (gio_hang_id, san_pham_id, so_luong) VALUES(:gio_hang_id, :san_pham_id, :so_luong)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(
          [
            ':gio_hang_id' => $gio_hang_id,
            ':san_pham_id' => $san_pham_id,
            ':so_luong' => $so_luong,
  
  
          ]
        );
        return true;
      } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
      }
    }
  
    public function clearDetailGioHang($gioHangId)
    {
      try {
        $sql = 'DELETE FROM chi_tiet_gio_hangs WHERE gio_hang_id =:gio_hang_id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':gio_hang_id' => $gioHangId]);
        return true;
      } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
      }
    }
  
  
    public function clearGioHang($taiKhoanId)
    {
      try {
        $sql = 'DELETE FROM gio_hangs WHERE tai_khoan_id =:tai_khoan_id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':tai_khoan_id' => $taiKhoanId]);
        return true;
      } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
      }
    }
  
  
 
//     public function getCartDetailByProduct($gioHangId, $sanPhamId)
// {
//     $sql = "SELECT * FROM chi_tiet_gio_hang 
//             WHERE gio_hang_id = :gio_hang_id 
//             AND san_pham_id = :san_pham_id";
    
//     $stmt = $this->conn->prepare($sql);
//     // $stmt->e(, PDO::PARAM_INT);
//     // $stmt->bindParam( PDO::PARAM_INT);
//    $tk= $stmt->execute([':gio_hang_id'=> $gioHangId,':san_pham_id'=> $sanPhamId,]
   
// );
// var_dump($stmt);die;
    
//     return $stmt->fetch(PDO::FETCH_ASSOC);
// }
// Ví dụ trong model CartModel
public function  getDetailGioHangFromProductId($sanPhamId) {
  // Truy vấn cơ sở dữ liệu để lấy thông tin sản phẩm và chi tiết giỏ hàng từ ID sản phẩm
  $sql = "
      SELECT sp.*, cth.*
      FROM san_phams sp
      LEFT JOIN chi_tiet_gio_hangs cth ON sp.id = cth.san_pham_id
      WHERE sp.id = :sanPhamId
  ";
  $stmt = $this->conn->prepare($sql);
  $stmt->bindParam(':sanPhamId', $sanPhamId, PDO::PARAM_INT);
  $stmt->execute();

  // Trả về thông tin sản phẩm và chi tiết giỏ hàng hoặc một mảng trống nếu không tìm thấy
  return $stmt->fetch(PDO::FETCH_ASSOC);
}





  


}
    
