<?php
require_once 'models/modelsaoni.php';

class ControllerAoni{
    private $productModel;

    public function __construct($conn) {
        $this->productModel = new modelsAoni($conn);
    }

    // Hiển thị sản phẩm theo danh mục
    public function showProducts($category_id) {
        $products = $this->productModel->getProductsByCategory($category_id);
        require_once 'view/viewaoni.php'; // Gọi View để hiển thị sản phẩm
    }
}
?>
