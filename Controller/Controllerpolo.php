<?php
require_once 'models/modelspolo.php';

class ControllerPolo {
    private $productModel;

    public function __construct($conn) {
        $this->productModel = new modelsPolo($conn);
    }

    // Hiển thị sản phẩm theo danh mục
    public function showProducts($category_id) {
        $products = $this->productModel->getProductsByCategory($category_id);
        require_once 'view/viewpolo.php'; // Gọi View để hiển thị sản phẩm
    }
}
?>
