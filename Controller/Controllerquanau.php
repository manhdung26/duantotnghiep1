<?php
require_once 'models/modelsquanau.php';

class ControllerQuanau {
    private $productModel;

    public function __construct($conn) {
        $this->productModel = new modelsQuanau($conn);
    }

    // Hiển thị sản phẩm theo danh mục
    public function showProducts($category_id) {
        $products = $this->productModel->getProductsByCategory($category_id);
        require_once 'view/viewquanau.php'; // Gọi View để hiển thị sản phẩm
    }
}
?>
