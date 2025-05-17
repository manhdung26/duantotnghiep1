<?php
require_once 'models/modelsDT.php';

class Controllerdt {
    public function index() {
        $conn = new mysqli("localhost", "root", "", "detaitotnghiep");
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        $model = new modelsdt($conn);
        $doanhThu = $model->getDoanhThuTheoThang();

        $labels = array_column($doanhThu, 'thang');
        $data = array_column($doanhThu, 'tong');

        include 'view/viewDT.php';

        $conn->close();
    }
}
?>
