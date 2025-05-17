<?php
require_once 'models/modelssua_sanpham.php';

class ControllerSuasanpham {
    public function sua() {
        $model = new ModelSanpham();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
            $id = $_GET['id'];
            $model->update($id, $_POST, $_FILES);
            header("Location: indexSP.php");
            exit();
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $product = $model->getById($id);
            include 'view/viewsua_sanpham.php';
        } else {
            echo "ID sản phẩm không hợp lệ!";
        }
    }
}
