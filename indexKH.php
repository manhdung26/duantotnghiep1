<?php
require_once('config/config.php'); // Bao gồm file cấu hình kết nối
require_once('controller/ControllerKh.php'); // Bao gồm controller

$conn = Config::connect(); 

// Khởi tạo controller và gọi phương thức index
$controller = new KhachHangController($conn);
$controller->index();  // Gọi phương thức index để hiển thị danh sách đơn hàng

// Đóng kết nối
$conn->close();
?>
