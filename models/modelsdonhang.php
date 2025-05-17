<?php
class DonHangModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Lấy danh sách đơn hàng
    public function getAllOrders() {
        $sql = "SELECT id, ten_khach_hang, id_khachhang, ngay_dat, gio_dat, tong_tien, trang_thai, phuong_thuc_thanh_toan FROM donhang ORDER BY ngay_dat DESC";
        $result = $this->conn->query($sql);
        return $result;
    }
}
?>
