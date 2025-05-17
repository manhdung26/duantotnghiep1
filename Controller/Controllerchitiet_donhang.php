<?php
require_once "models/modelschitiet_donhang.php";

class ControllerChitiet_donhang {
    public function chiTiet($id_donhang) {
        $model = new modelsChitiet_donhang();
        $sanphams = $model->getSanPhamTrongDonHang($id_donhang);
        $donhang_info = $model->getThongTinDonHang($id_donhang);

        include "view/viewchitiet_donhang.php";
    }
}
