<?php
require_once 'models/modelsquangio.php';

class ControllerQuangio {
    private $productModel;

    public function __construct($conn) {
        $this->productModel = new modelsQuangio($conn);
    }

    // Hiển thị sản phẩm theo danh mục
    public function showProducts($category_id) {
        $products = $this->productModel->getProductsByCategory($category_id);
        require_once 'view/viewquangio.php'; // Gọi View để hiển thị sản phẩm
    }
}
?>
