<?php
require_once 'models/modelssuadonhang.php';
require_once 'models/modelssuadonhang1.php';

class ControllerSuadonhang {
    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            die("Thiếu ID đơn hàng.");
        }

        $order = Order::find($id);
        $customers = Customer::all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id_khachhang' => (int)$_POST['id_khachhang'],
                'ten_khach_hang' => $_POST['ten_khach_hang'],
                'ngay_dat' => $_POST['ngay_dat'] ?: $order['ngay_dat'],
                'gio_dat' => $_POST['gio_dat'] ?: $order['gio_dat'],
                'tong_tien' => $_POST['tong_tien'],
                'trang_thai' => $_POST['trang_thai'],
            ];

            if (Order::update($id, $data)) {
                header("Location: indexdonhang.php");
                exit;
            } else {
                echo "Lỗi cập nhật đơn hàng.";
            }
        }

        include 'view/viewSuadonhang.php';
    }
}
