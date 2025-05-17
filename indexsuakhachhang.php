<?php
require_once 'config/config.php'; // Kết nối CSDL
require_once 'controller/Controllersuakhachhang.php'; // Gọi controller

// Khởi tạo kết nối
$conn = Config::connect(); // Sử dụng Config::connect() để lấy kết nối

// Kiểm tra nếu có ID trong URL
$id = isset($_GET['id']) ? $_GET['id'] : 0;

if ($id > 0) {
    // Khởi tạo đối tượng controller và truyền kết nối
    $controller = new ControllerSuakhachhang($conn); // Truyền kết nối $conn vào
    $customer = $controller->edit($id); // Lấy thông tin khách hàng
    include 'view/viewsuakhachhang.php'; // Hiển thị form sửa khách hàng
} else {
    echo "ID khách hàng không hợp lệ.";
}
?>
