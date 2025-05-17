<?php
require_once 'models/modelsshortdui.php';

class ControllerShortdui {
    private $productModel;

    public function __construct($conn) {
        $this->productModel = new modelsShortdui($conn);
    }

    // Hiển thị sản phẩm theo danh mục
    public function showProducts($category_id) {
        $products = $this->productModel->getProductsByCategory($category_id);
        require_once 'view/viewshortdui.php'; // Gọi View để hiển thị sản phẩm
    }
}
?>
