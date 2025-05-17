<?php
class modelDanhmuc {
    private $conn;

    public function __construct() {
        require_once 'config/Config.php'; // File kết nối cơ sở dữ liệu
        $this->conn = Config::connect(); // Sử dụng Config::connect() vì Config là static
    }

    public function getAllDanhmuc() {
        $sql = "SELECT * FROM danhmuc";
        $result = $this->conn->query($sql);

        if ($result === false) {
            die("Lỗi truy vấn: " . $this->conn->error);
        }

        // Fetch tất cả các kết quả
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }
}
