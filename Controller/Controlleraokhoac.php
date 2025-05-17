<?php
require_once 'models/modelsaokhoac.php';

class ControllerAokhoac {
    private $productModel;

    public function __construct($conn) {
        $this->productModel = new modelsAokhoac($conn);
    }

    // Hiển thị sản phẩm theo danh mục
    public function showProducts($category_id) {
        $products = $this->productModel->getProductsByCategory($category_id);
        require_once 'view/viewaokhoac.php'; // Gọi View để hiển thị sản phẩm
    }
    
}
?>
