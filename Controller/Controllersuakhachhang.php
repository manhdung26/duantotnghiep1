<?php
// controllers/CustomerController.php
require_once 'models/modelssuakhachhang.php';

class ControllerSuakhachhang {
    private $model;

    public function __construct($conn) {
        $this->model = new modelsSuakhachhang($conn); // Truyền kết nối vào model
    }

    public function edit($id) {
        $customer = $this->model->getById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ten_khach_hang = trim($_POST['ten_khach_hang']);
            $email = trim($_POST['email']);
            $so_dien_thoai = trim($_POST['so_dien_thoai']);
            $dia_chi = trim($_POST['dia_chi']);

            $errors = $this->validate($ten_khach_hang, $email, $so_dien_thoai);

            if (empty($errors)) {
                $this->model->update($id, $ten_khach_hang, $email, $so_dien_thoai, $dia_chi);
                header("Location: indexKH.php");
                exit();
            } else {
                return $errors;
            }
        }

        return $customer;
    }

    private function validate($ten_khach_hang, $email, $so_dien_thoai) {
        $errors = [];

        if (empty($ten_khach_hang)) {
            $errors[] = "Tên khách hàng không được để trống.";
        }

        if (empty($email)) {
            $errors[] = "Email không được để trống.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email không đúng định dạng.";
        } elseif (substr($email, -10) !== "@gmail.com") {
            $errors[] = "Email phải kết thúc bằng @gmail.com.";
        }

        if (!empty($so_dien_thoai)) {
            if (!preg_match('/^[0-9]{9,11}$/', $so_dien_thoai)) {
                $errors[] = "Số điện thoại phải từ 9-11 chữ số và chỉ chứa số.";
            }
        }

        return $errors;
    }
}