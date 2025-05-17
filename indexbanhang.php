<?php
// Bắt đầu session và kiểm tra đăng nhập
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Gọi controller bán hàng
require_once './controller/Controllerbanhang.php';
$controller = new ControllerBanHang();
$controller->handleRequest();
?>
