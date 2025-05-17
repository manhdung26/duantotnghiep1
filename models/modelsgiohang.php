<?php
class modelsGiohang {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    public function getCart() {
        return $_SESSION['cart'];
    }

    public function getTotal() {
        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    public function addToCart($product_id) {
        $product_id = (int)$product_id;
        $sql = "SELECT * FROM sanpham WHERE id = $product_id";
        $result = $this->conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $product = $result->fetch_assoc();
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
        }
    }

    public function removeFromCart($product_id) {
        unset($_SESSION['cart'][$product_id]);
    }

    public function updateCart($quantities) {
        foreach ($quantities as $id => $qty) {
            $qty = (int)$qty;
            if ($qty > 0 && isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id]['quantity'] = $qty;
            }
        }
    }
}
