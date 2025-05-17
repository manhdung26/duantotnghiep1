<?php
require_once 'models/modelsshortgio.php';

class ControllerShortgio {
    private $productModel;

    public function __construct($conn) {
        $this->productModel = new modelsShortgio($conn);
    }

    // Hiển thị sản phẩm theo danh mục
    public function showProducts($category_id) {
        $products = $this->productModel->getProductsByCategory($category_id);
        require_once 'view/viewshortgio.php'; // Gọi View để hiển thị sản phẩm
    }
}
?>
