<?php
require_once 'config/config.php';

class modelsXoasanpham {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli("localhost", "root", "", "detaitotnghiep");
        if ($this->conn->connect_error) {
            die("Kết nối thất bại: " . $this->conn->connect_error);
        }
    }

    public function xoaSanPham($id) {
        $sql = "DELETE FROM sanpham WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>