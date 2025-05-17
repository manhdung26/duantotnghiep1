<?php
class modelsXoadonhang {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli("localhost", "root", "", "detaitotnghiep");
        if ($this->conn->connect_error) {
            die("Kết nối thất bại: " . $this->conn->connect_error);
        }
    }

    public function xoaDonHang($id) {
        $sql = "DELETE FROM donhang WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
