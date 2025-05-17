<?php
require_once 'models/modelsshortkaki.php';

class ControllerShortkaki {
    private $productModel;

    public function __construct($conn) {
        $this->productModel = new modelsShortkaki($conn);
    }

    // Hiển thị sản phẩm theo danh mục
    public function showProducts($category_id) {
        $products = $this->productModel->getProductsByCategory($category_id);
        require_once 'view/viewshortkaki.php'; // Gọi View để hiển thị sản phẩm
    }
}
?>
