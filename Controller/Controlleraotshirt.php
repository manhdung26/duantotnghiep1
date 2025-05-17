<?php
require_once 'models/modelsaotshirt.php';

class ControllerAotshirt {
    private $productModel;

    public function __construct($conn) {
        $this->productModel = new modelsAotshirt($conn);
    }

    // Hiển thị sản phẩm theo danh mục
    public function showProducts($category_id) {
        $products = $this->productModel->getProductsByCategory($category_id);
        require_once 'view/viewaolen.php'; // Gọi View để hiển thị sản phẩm
    }
}
?>
