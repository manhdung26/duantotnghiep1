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
      position: relative;
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

    /* Carousel Styles */
    .carousel-container {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin-top: 20px;
    }

    .carousel-container img {
      width: 80px;
      height: 80px;
      object-fit: cover;
      cursor: pointer;
      border-radius: 8px;
      transition: transform 0.3s;
    }

    .carousel-container img:hover {
      transform: scale(1.1);
    }

    /* Phần ảnh quay lại ảnh chính */
    .back-to-main-image {
      width: 80px;
      height: 80px;
      object-fit: cover;
      cursor: pointer;
      border-radius: 8px;
      transition: transform 0.3s;
    }

    .back-to-main-image:hover {
      transform: scale(1.1);
    }
  </style>
</head>
<body>

<a href="indexSP.php" class="back-link">← Quay lại danh sách sản phẩm</a>

<?php if ($product): ?>
  <div class="container">
    <div class="product-image">
      <!-- Hiển thị ảnh chính của sản phẩm -->
      <img id="main-product-image" src="img/<?php echo htmlspecialchars($product['anh']); ?>" alt="<?php echo htmlspecialchars($product['ten']); ?>">

      <!-- Carousel hiển thị các ảnh khác của sản phẩm -->
      <div class="carousel-container">
        <!-- Hình ảnh quay lại ảnh chính được thêm vào carousel -->
        <img src="img/<?php echo htmlspecialchars($product['anh']); ?>" alt="Ảnh chính" class="back-to-main-image" onclick="resetMainImage()">

        <?php
        // Hiển thị ảnh phụ nếu có
        for ($i = 1; $i <= 4; $i++) {
          if (!empty($product["anh$i"])) {
            echo "<img src='img/{$product["anh$i"]}' alt='Ảnh phụ $i' onclick='changeImage(\"{$product["anh$i"]}\")'>";
          }
        }
        ?>
      </div>
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

<script>
  // Hàm để thay đổi ảnh chính khi người dùng click vào ảnh trong carousel
  function changeImage(imageName) {
    document.getElementById('main-product-image').src = "img/" + imageName;
  }

  // Hàm quay lại ảnh chính
  function resetMainImage() {
    const mainImage = "<?php echo htmlspecialchars($product['anh']); ?>";
    document.getElementById('main-product-image').src = "img/" + mainImage;
  }
</script>

</body>
</html>