<?php
require_once "controller/Controllerchitiet_donhang.php";

$id = $_GET['id'] ?? 0;
$controller = new ControllerChitiet_donhang();
$controller->chiTiet($id);
