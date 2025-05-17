<?php
require_once 'models/modelsxoadonhang.php';

class Controllerxoadonhang {
    public function xoaDonHang() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $model = new modelsXoadonhang();
            if ($model->xoaDonHang($id)) {
                header("Location: indexdonhang.php");
                exit();
            } else {
                echo "Lỗi khi xóa đơn hàng.";
            }
        }
    }
}
?>

