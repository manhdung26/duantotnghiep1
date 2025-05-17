<?php
require_once 'models/modelsquankaki.php';

class ControllerQuankaki {
    private $productModel;

    public function __construct($conn) {
        $this->productModel = new modelsQuankaki($conn);
    }

    // Hiển thị sản phẩm theo danh mục
    public function showProducts($category_id) {
        $products = $this->productModel->getProductsByCategory($category_id);
        require_once 'view/viewquankaki.php'; // Gọi View để hiển thị sản phẩm
    }
}
?>
