<?php
require_once "models/modelschitietsanpham.php";

class ControllerChitietsanpham {
    public function chiTiet($id) {
        $model = new modelsChitietsanpham();
        $product = $model->getSanPhamById($id);

        include "view/viewchitietsanpham.php";
    }
}
