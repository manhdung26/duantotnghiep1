<?php
session_start();
require_once './Controller/Controllerthanhtoan.php';

$controller = new ControllerThanhtoan();
$controller->thanhtoan(); // Xử lý nếu có POST

include './view/viewthanhtoan.php'; // Hiển thị giao diện
