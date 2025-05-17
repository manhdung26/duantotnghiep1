<?php
require_once 'models/modelsaosomi.php';

class ControllerAosomi {
    private $productModel;

    public function __construct($conn) {
        $this->productModel = new modelsAosomi($conn);
    }

    // Hiển thị sản phẩm theo danh mục
    public function showProducts($category_id) {
        $products = $this->productModel->getProductsByCategory($category_id);
        require_once 'view/viewaosomi.php'; // Gọi View để hiển thị sản phẩm
    }
}
?>
