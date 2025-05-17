<?php
require_once 'config/config.php';
require_once 'controller/Controllerlogin.php';

$conn = Config::connect();
$controller = new ControllerLogin($conn);
$controller->login();
