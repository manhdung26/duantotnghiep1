<?php
require_once "config/config.php";

class SanPhamModel {
    private $conn;

    public function __construct() {
        $this->conn = Config::connect();  // phải gán vào $this->conn
    
        if (!$this->conn) {
            die("Không thể kết nối đến cơ sở dữ liệu.");
        }
    }
  public function getAll($search = '', $status = '', $danhmuc_id = '') {
    $sql = "SELECT sanpham.*, danhmuc.ten_danhmuc AS ten_danh_muc
            FROM sanpham
            LEFT JOIN danhmuc ON sanpham.danhmuc_id = danhmuc.id
            WHERE 1";

    if (!empty($search)) {
        $search = $this->conn->real_escape_string($search);
        $sql .= " AND sanpham.ten LIKE '%$search%'";
    }

    if ($status === 'conhang') {
        $sql .= " AND sanpham.so_luong > 0";
    } elseif ($status === 'hethang') {
        $sql .= " AND sanpham.so_luong = 0";
    }

    if (!empty($danhmuc_id)) {
    $danhmuc_id = (int)$danhmuc_id;
    $sql .= " AND sanpham.danhmuc_id = $danhmuc_id";
}

    $sql .= " ORDER BY sanpham.id DESC";

    $result = $this->conn->query($sql);
    if (!$result) {
        die("Truy vấn thất bại: " . $this->conn->error);
    }

    $sanphams = [];
    while ($row = $result->fetch_assoc()) {
        $sanphams[] = $row;
    }

    return $sanphams;
}


public function getAllCategories() {
    $sql = "SELECT * FROM danhmuc ORDER BY ten_danhmuc ASC";
    $result = $this->conn->query($sql);

    $categories = [];
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }

    return $categories;
}
}