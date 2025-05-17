<?php
class modelsdt {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getDoanhThuTheoThang() {
        $sql = "SELECT MONTH(ngay_dat) AS thang, SUM(tong_tien) AS tong
                FROM donhang
                WHERE trang_thai = 'Hoàn thành'
                GROUP BY MONTH(ngay_dat)
                ORDER BY thang";
        $result = $this->conn->query($sql);
        $data = [];

        while ($row = $result->fetch_assoc()) {
            $data[] = [
                'thang' => "Tháng " . $row['thang'],
                'tong' => $row['tong']
            ];
        }

        return $data;
    }
}
?>
