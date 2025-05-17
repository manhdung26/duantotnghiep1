<?php
session_start();
$conn = new mysqli("localhost", "root", "", "detaitotnghiep");
$conn->set_charset("utf8");

require_once 'controller/Controllergiohang.php';

$controller = new ControllerGiohang($conn);
$controller->handleRequest();
