<?php
require_once 'config/config.php';
require_once 'controller/Controllerthemdonhang.php';

$conn = Config::connect();

// Tạo đối tượng ControllerThemdonhang
$orderController = new ControllerThemdonhang($conn);

// Kiểm tra nếu là POST request để thêm đơn hàng
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Thêm khách hàng và đơn hàng
    $orderController->addOrder();
} else {
    // Hiển thị form thêm đơn hàng khi là GET request
    $orderController->showAddOrderForm();
}

$conn->close();
?>
