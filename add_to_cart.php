<?php
require_once './controller/Controllerbanhang.php';
$controller = new ControllerBanHang();
$controller->handleRequest();
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $productId = (int) $_POST['product_id'];

    // Kết nối DB
    require_once 'config.php';

    $stmt = $conn->prepare("SELECT * FROM sanpham WHERE id = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if ($product) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (!isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] = [
                'id' => $product['id'],
                'ten' => $product['ten'],
                'gia' => $product['gia'],
                'anh' => $product['anh'],
                'so_luong' => 1
            ];
        } else {
            $_SESSION['cart'][$productId]['so_luong']++;
        }

        echo json_encode(['success' => true, 'message' => 'Đã thêm vào giỏ hàng']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Sản phẩm không tồn tại']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Yêu cầu không hợp lệ']);
}
?>