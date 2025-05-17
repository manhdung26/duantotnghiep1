<?php
require_once 'config/config.php';

class modelsSuakhachhang {
    private $conn;

    // Nhận kết nối từ controller
    public function __construct($conn) {
        $this->conn = Config::connect();
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM khachhang WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function update($id, $ten_khach_hang, $email, $so_dien_thoai, $dia_chi) {
        $stmt = $this->conn->prepare("UPDATE khachhang SET ten_khach_hang = ?, email = ?, so_dien_thoai = ?, dia_chi = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $ten_khach_hang, $email, $so_dien_thoai, $dia_chi, $id);
        return $stmt->execute();
    }
}
