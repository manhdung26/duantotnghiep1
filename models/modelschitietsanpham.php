<?php
require_once "config/config.php";

class modelsChitietsanpham {
    private $conn;

    public function __construct() {
        $this->conn = Config::connect();
    }

    public function getSanPhamById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM sanpham WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();
        $stmt->close();
        return $product;
    }
}
