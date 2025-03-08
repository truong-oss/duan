<?php
class ChartModel {
    private $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    
    public function getSalesData() {
        $sql = "SELECT DATE(ngay_dat) AS month, SUM(tong_tien) AS revenue FROM don_hangs GROUP BY month";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        if (empty($data)) {
            return ['labels' => [], 'data' => []]; // Trả về mảng rỗng nếu không có dữ liệu
        }
    
        $labels = [];
        $revenues = [];
        foreach ($data as $row) {
            $labels[] = $row['month'];
            $revenues[] = $row['revenue'];
        }
    
        return [
            'labels' => $labels,
            'data' => $revenues,
        ];
    }
}