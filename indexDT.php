<?php
require_once('config/config.php'); // Bao gồm file cấu hình kết nối
require_once('controller/ControllerDT.php'); // Bao gồm controller

// Khởi tạo kết nối CSDL
$conn = Config::connect();

// Khởi tạo controller và gọi phương thức index
$controller = new Controllerdt($conn);
$controller->index();  // Gọi phương thức index để hiển thị danh sách đơn hàng

// Đóng kết nối
$conn->close();
?>
