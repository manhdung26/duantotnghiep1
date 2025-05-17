<?php
session_start();
require_once __DIR__ . '/../models/modelslogin.php';

class ControllerLogin {
    private $model;

    public function __construct($conn) {
        $this->model = new modelsLogin($conn);
    }

 public function login() {
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($username === '' || $password === '') {
            $error = "Vui lòng nhập tên đăng nhập và mật khẩu.";
        } else {
            $user = $this->model->checkLogin($username, $password);
            if ($user) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role']; // Lưu role để sau này dùng

                // Điều hướng dựa trên vai trò
                if ($user['role'] === 'admin') {
                    header("Location:index.php");
                } else if ($user['role'] === 'seller') {
                    header("Location:indexbanhang.php");
                } else {
                    $error = "Không xác định được quyền truy cập.";
                }
                exit();
            } else {
                $error = "Tên đăng nhập hoặc mật khẩu không đúng.";
            }
        }
    }

    require_once __DIR__ . '/../view/viewlogin.php';
}
}
