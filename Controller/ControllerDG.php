<?php
include_once 'models/modelsDG.php';

class daodiencontroller {
    private $model;

    public function __construct() {
        // Kết nối CSDL
        $db = new mysqli("localhost", "root", "", "detaitotnghiep");
        if ($db->connect_error) {
            die("Kết nối thất bại: " . $db->connect_error);
        }

        // Khởi tạo model
        $this->model = new daodienmodels($db);
    }

    public function index() {
        // Lấy dữ liệu từ model
        $total_sanpham = $this->model->getTotalProducts();
        $total_donhang_ngay = $this->model->getTodayOrders();
        $total_customers = $this->model->getTotalCustomers();
        $revenue_data = $this->model->getRevenueLast7Days();
        $order_status_data = $this->model->getOrderStatusCounts();
        $status_counts = $this->model->getOrderStatusCounts();
        $recent_orders = $this->model->getRecentOrders();
        $top_products = $this->model->getTopSellingProducts();

        // Gửi dữ liệu sang View
        include 'view/viewDG.php';
    }
}
?>
