<?php
class modelsAotshirt {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Lấy danh sách sản phẩm theo danh mục
    public function getProductsByCategory($category_id) {
        $product_sql = "SELECT * FROM sanpham WHERE danhmuc_id = ? ORDER BY id DESC";
        $stmt = $this->conn->prepare($product_sql);
        $stmt->bind_param("i", $category_id); // Bảo vệ SQL Injection
        $stmt->execute();
        $result = $stmt->get_result();

        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        return $products;
    }
}
?>
