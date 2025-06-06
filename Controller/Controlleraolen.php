<?php
require_once 'models/modelsaolen.php';

class ControllerAolen {
    private $productModel;

    public function __construct($conn) {
        $this->productModel = new modelsAolen($conn);
    }

    // Hiển thị sản phẩm theo danh mục
    public function showProducts($category_id) {
        $products = $this->productModel->getProductsByCategory($category_id);
        require_once 'view/viewaolen.php'; // Gọi View để hiển thị sản phẩm
    }
}
?>
