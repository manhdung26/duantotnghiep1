<?php
include_once 'models/modelsdonhang.php';

class DonHangController {
    private $conn;
    private $model;

    public function __construct($conn) {
        $this->conn = $conn;
        $this->model = new DonHangModel($this->conn);
    }

    public function index() {
        // Lấy danh sách đơn hàng từ model
        $orders = $this->model->getAllOrders();
        // Truyền dữ liệu vào view
        include 'view/viewDonhang.php';
    }
}
?>
