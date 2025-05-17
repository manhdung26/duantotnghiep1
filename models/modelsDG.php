<?php
class daodienmodels {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getTotalProducts() {
        $result = $this->conn->query("SELECT COUNT(*) AS tong_so_san_pham FROM sanpham");
        return $result ? $result->fetch_assoc()['tong_so_san_pham'] : 0;
    }

    public function getTodayOrders() {
        $today = date('Y-m-d');
        $result = $this->conn->query("SELECT COUNT(*) AS tong_so_don_hang_hom_nay FROM donhang WHERE DATE(ngay_dat) = '$today'");
        return $result ? $result->fetch_assoc()['tong_so_don_hang_hom_nay'] : 0;
    }

    public function getTotalCustomers() {
        $result = $this->conn->query("SELECT COUNT(*) AS tong_so_khach_hang FROM khachhang");
        return $result ? $result->fetch_assoc()['tong_so_khach_hang'] : 0;
    }

    public function getRevenueLast7Days() {
        $revenue = [];
        $days = [];

        for ($i = 6; $i >= 0; $i--) {
            $day = date('Y-m-d', strtotime("-$i days"));
            $days[] = date('D', strtotime($day));
            $query = "SELECT SUM(tong_tien) as daily_revenue FROM donhang WHERE DATE(ngay_dat) = '$day'";
            $res = $this->conn->query($query);
            $row = $res->fetch_assoc();
            $revenue[] = $row['daily_revenue'] ?? 0;
        }

        return ['days' => $days, 'revenue' => $revenue];
    }

    public function getOrderStatusCounts() {
        $status_counts = [];
        $result = $this->conn->query("SELECT trang_thai, COUNT(*) as count FROM donhang WHERE trang_thai IS NOT NULL AND trang_thai != '' GROUP BY trang_thai");
        while ($row = $result->fetch_assoc()) {
            $status_counts[$row['trang_thai']] = $row['count'];
        }
        return $status_counts;
    }

    public function getRecentOrders() {
        $recent_orders = [];
        $result = $this->conn->query("SELECT donhang.id, donhang.ngay_dat, khachhang.ten_khach_hang, donhang.tong_tien 
                                      FROM donhang
                                      JOIN khachhang ON donhang.id_khachhang = khachhang.id
                                      ORDER BY donhang.ngay_dat DESC LIMIT 5");
        while ($row = $result->fetch_assoc()) {
            $recent_orders[] = $row;
        }
        return $recent_orders;
    }

    public function getTopSellingProducts() {
        $top_products = [];
        $result = $this->conn->query("SELECT sanpham.ten AS ten_san_pham, SUM(donhang_sanpham.so_luong) AS total_sold
                                      FROM donhang_sanpham
                                      JOIN sanpham ON donhang_sanpham.id_sanpham = sanpham.id
                                      GROUP BY sanpham.id, sanpham.ten
                                      ORDER BY total_sold DESC LIMIT 5");
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $top_products[] = $row;
            }
        }
        return $top_products;
    }
}
?>
