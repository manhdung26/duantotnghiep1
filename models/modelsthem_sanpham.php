<?php
require_once 'config/config.php';

class modelsThem_sanpham {
    private $conn;
    private $table = "sanpham";

    public function __construct() {
        $this->conn = Config::connect();
    }

    public function create($data) {
        $stmt = $this->conn->prepare("
    INSERT INTO $this->table 
    (ten, gia, so_luong, mota, anh, anh2, anh3, anh4, chatlieu, kichthuoc, mausac, baohanh, thuonghieu, danhmuc_id)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

$stmt->bind_param(
    "sdissssssssssi", // thêm 'i' cuối cùng cho id_danhmuc
    $data['ten'], $data['gia'], $data['so_luong'], $data['mota'], $data['anh'],
    $data['anh2'], $data['anh3'], $data['anh4'], $data['chatlieu'], $data['kichthuoc'],
    $data['mausac'], $data['baohanh'], $data['thuonghieu'], $data['danhmuc_id']
);

        return $stmt->execute();
    }
}
