<?php
include_once 'models/modelsKh.php';

class KhachHangController {
    private $model;

    // Constructor nhận kết nối từ bên ngoài
    public function __construct($conn) {
        $this->model = new modelskh($conn);
    }

    // Phương thức index hiển thị danh sách khách hàng
    public function index() {
        $result = $this->model->getAllCustomers();
        include 'view/viewKH.php';  // Gọi view để hiển thị dữ liệu
    }
}
?>
