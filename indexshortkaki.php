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

require_once 'controller/Controllershortkaki.php';

// Khởi tạo Controller và hiển thị sản phẩm theo danh mục
$productController = new ControllerShortkaki($conn);
$productController->showProducts(10);  // Hiển thị sản phẩm của danh mục "Áo Polo"
?>
