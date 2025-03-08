<?php
class ReportModel {
    private $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    public function getStatistics() {
        $sql = "SELECT 
                    dm.ten_danh_muc AS danh_muc,
                    COUNT(dh.ma_don_hang) AS tong_don_hang,
                    SUM(dh.tong_tien) AS tong_doanh_thu
                FROM 
                    danh_mucs dm
                LEFT JOIN 
                    san_phams sp ON dm.id = sp.danh_muc_id
                LEFT JOIN 
                    chi_tiet_don_hangs ctdh ON sp.id = ctdh.san_pham_id
                LEFT JOIN 
                    don_hangs dh ON ctdh.don_hang_id = dh.id
                GROUP BY 
                    dm.ten_danh_muc;";

               
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>