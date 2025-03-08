<?php
class AdminBaoCaoThongKe{
    public $model1;
    public $chartModel;
    public $reportModel;
    public function __construct() {
        $this->model1 = new DashboardModel();
        $this->chartModel = new ChartModel();
        $this->reportModel = new ReportModel();
    }

    public function home() {
        $data = [
            'totalUsers' => $this->model1->getTotalUsers(),
            'totalCategories' => $this->model1->getTotalCategories(),
            'totalProducts' => $this->model1->getTotalProducts(),
            'totalOrders' => $this->model1->getTotalAmount(),
        ];
        
        // Lấy dữ liệu biểu đồ
        $data1 = $this->chartModel->getSalesData(); 
        $statistics = $this->reportModel->getStatistics();
        require_once './views/home.php';
    }
  
}