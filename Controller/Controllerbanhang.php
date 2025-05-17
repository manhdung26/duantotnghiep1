<?php
require_once './models/modelsbanhang.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class ControllerBanHang {
    private $model;

    public function __construct() {
        $this->model = new ModelBanHang();
    }

    public function handleRequest() {
        // Lấy danh mục
        $categories = $this->model->getCategories();

        // Xử lý thêm vào giỏ hàng
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
            $this->addToCart($_POST['product_id']);
        }

        // Lấy danh sách sản phẩm
        $featured = $this->model->getFeaturedProducts();
        $all = $this->model->getAllProducts();

        // Hiển thị view
        include './view/viewbanhang.php';
    }

    private function addToCart($product_id) {
        if (!isset($product_id) || !is_numeric($product_id)) {
            echo json_encode(['success' => false, 'message' => 'ID không hợp lệ']);
            exit;
        }

        $product = $this->model->getProductById($product_id);
        if (!$product) {
            echo json_encode(['success' => false, 'message' => 'Không tìm thấy sản phẩm']);
            exit;
        }

        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity']++;
        } else {
            $_SESSION['cart'][$product_id] = [
                'name' => $product['ten'],
                'price' => $product['gia'],
                'quantity' => 1,
                'image' => $product['anh']
            ];
        }

        echo json_encode(['success' => true]);
        exit;
    }
}
?>
