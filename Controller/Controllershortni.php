<?php
require_once 'models/modelsshortni.php';

class ControllerShortni {
    private $productModel;

    public function __construct($conn) {
        $this->productModel = new modelsShortni($conn);
    }

    // Hiển thị sản phẩm theo danh mục
    public function showProducts($category_id) {
        $products = $this->productModel->getProductsByCategory($category_id);
        require_once 'view/viewshortni.php'; // Gọi View để hiển thị sản phẩm
    }
}
?>
