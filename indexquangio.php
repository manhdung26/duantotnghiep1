<?php
session_start();
$host = 'localhost';
$db = 'detaitotnghiep';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

require_once 'controller/Controllerquangio.php';

// Khởi tạo Controller và hiển thị sản phẩm theo danh mục
$productController = new ControllerQuangio($conn);
$productController->showProducts(5);  // Hiển thị sản phẩm của danh mục "Áo Polo"
?>
