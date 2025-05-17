<?php
require_once 'models/modelsxoa_sanpham.php';

class ControllerXoasanpham {
    public function xoaSanPham() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $model = new modelsXoasanpham();
            if ($model->xoaSanPham($id)) {
                header("Location: indexSP.php");
                exit();
            } else {
                echo "Lỗi khi xóa sản phẩm.";
            }
        } else {
            echo "ID không hợp lệ.";
        }
    }
}
?>
