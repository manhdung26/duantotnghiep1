<?php
class ModelBanHang {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli('localhost', 'root', '', 'detaitotnghiep');
        if ($this->conn->connect_error) {
            die("Kết nối thất bại: " . $this->conn->connect_error);
        }
    }

    public function getCategories() {
        $sql = "SELECT * FROM danhmuc";
        return $this->conn->query($sql);
    }

    public function getFeaturedProducts() {
        $sql = "SELECT * FROM sanpham WHERE noi_bat = 1 ORDER BY id DESC LIMIT 8";
        return $this->conn->query($sql);
    }

    public function getAllProducts() {
        $sql = "SELECT * FROM sanpham ORDER BY id DESC";
        return $this->conn->query($sql);
    }

    public function getProductById($id) {
    $stmt = $this->conn->prepare("SELECT * FROM sanpham WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}
}
