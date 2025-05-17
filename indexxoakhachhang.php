<?php
// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "detaitotnghiep");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Yêu cầu controller xử lý
require_once 'controller/Controllerxoakhachhang.php';
$controller = new KhachHangController($conn);
$controller->deleteCustomer();
?>
