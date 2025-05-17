<?php
require_once "controller/Controllerchitietsanpham.php";

$id = $_GET['id'] ?? 0;
$controller = new ControllerChitietsanpham();
$controller->chiTiet($id);
