<?php
// Kết nối CSDL
require_once 'config/config.php'; // Kết nối đến cơ sở dữ liệu

// Tạo kết nối
$conn = Config::connect();

// Gọi controller và xử lý yêu cầu
require_once 'controller/Controllerthemkhachhang.php';
$controller = new KhachHangController($conn);
$controller->addCustomer(); // Thêm khách hàng
?>
