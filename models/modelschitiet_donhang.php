<?php
require_once "config/config.php";

class modelsChitiet_donhang {
    private $conn;

    public function __construct() {
        $this->conn = Config::connect();
    }

    public function getSanPhamTrongDonHang($id_donhang) {
        $sql = "SELECT sp.ten, sp.anh, dssp.so_luong, sp.gia 
                FROM donhang_sanpham dssp
                JOIN sanpham sp ON dssp.id_sanpham = sp.id
                WHERE dssp.id_donhang = $id_donhang";
        return $this->conn->query($sql);
    }

    public function getThongTinDonHang($id_donhang) {
        $sql = "SELECT tong_tien, phuong_thuc_thanh_toan FROM donhang WHERE id = $id_donhang";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }
}
