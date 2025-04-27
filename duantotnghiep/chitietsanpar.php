<?php
$conn = new mysqli("localhost", "root", "", "detaitotnghiep");
if ($conn->connect_error) {
  die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy ID sản phẩm từ URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Truy vấn chi tiết sản phẩm
if ($id > 0) {
    $stmt = $conn->prepare("SELECT * FROM sanpham WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();
} else {
    $product = null;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Chi tiết sản phẩm</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background: #f4f4f4;
      padding: 40px;
    }

    .container {
      max-width: 1000px;
      margin: auto;
      background: white;
      border-radius: 10px;
      display: flex;
      gap: 40px;
      padding: 30px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .product-image {
      flex: 1;
    }

    .product-image img {
      width: 100%;
      height: auto;
      border-radius: 12px;
      object-fit: cover;
    }

    .product-info {
      flex: 1;
    }

    .product-info h2 {
      margin-top: 0;
      font-size: 28px;
    }

    .product-info p {
      font-size: 16px;
      color: #555;
      line-height: 1.5;
    }

    .price {
      margin-top: 15px;
      font-size: 22px;
      color: #e74c3c;
      font-weight: bold;
    }

    .back-link {
      display: inline-block;
      margin-bottom: 20px;
      padding: 8px 16px;
      text-decoration: none;
      color: blue;
      border: 2px solid #ccc;
      border-radius: 6px;
      transition: all 0.3s ease;
      font-weight: bold;
     }

    .back-link:hover {
     color: #e74c3c;
     border-color: #e74c3c;
     background-color: #fff0f0;
    }

    .back-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<a href="sanpham.php" class="back-link">← Quay lại danh sách sản phẩm</a>

<?php if ($product): ?>
  <div class="container">
    <div class="product-image">
      <img src="img/<?php echo htmlspecialchars($product['anh']); ?>" alt="<?php echo htmlspecialchars($product['ten']); ?>">
    </div>
    <div class="product-info">
      <h2><?php echo htmlspecialchars($product['ten']); ?></h2>
      <p><?php echo nl2br(htmlspecialchars($product['mota'])); ?></p>
      <div class="price"><?php echo number_format($product['gia'], 0, ',', '.') . '₫'; ?></div>
    </div>
  </div>
<?php else: ?>
  <p>Không tìm thấy sản phẩm.</p>
<?php endif; ?>

</body>
</html>
