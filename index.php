<?php
// Bắt đầu session và kiểm tra đăng nhập
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Bao gồm các file cần thiết
require_once('config/config.php'); 
require_once('controller/ControllerDG.php');

// Kết nối CSDL và gọi controller
$conn = Config::connect();
$controller = new daodiencontroller($conn);  
$controller->index();
?>
