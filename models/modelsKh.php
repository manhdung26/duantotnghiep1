<?php
class modelskh {
    private $conn;

    // Constructor nhận kết nối từ bên ngoài
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Phương thức lấy danh sách khách hàng
    public function getAllCustomers() {
        $sql = "SELECT * FROM khachhang ORDER BY ngay_dang_ky DESC";
        return $this->conn->query($sql);
    }
}
?>
