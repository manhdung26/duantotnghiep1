<?php
require_once 'models/modelsquanni.php';

class ControllerQuanni {
    private $productModel;

    public function __construct($conn) {
        $this->productModel = new modelsQuanni($conn);
    }

    // Hiển thị sản phẩm theo danh mục
    public function showProducts($category_id) {
        $products = $this->productModel->getProductsByCategory($category_id);
        require_once 'view/viewquanni.php'; // Gọi View để hiển thị sản phẩm
    }
}
?>
