<?php
class modelsXoakhachhang {
    private $conn;

    // Nhận kết nối từ controller
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Xóa khách hàng từ cơ sở dữ liệu
    public function deleteCustomer($id) {
        $sql = "DELETE FROM khachhang WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id); // "i" cho integer (id là số nguyên)
        
        return $stmt->execute();
    }
}
?>
