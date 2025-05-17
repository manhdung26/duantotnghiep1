<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Áo Polo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="danhmuc.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <a href="#">Fashion shop</a>
            </div>
            <nav>
                <ul>
                    <li><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
                    <li><a href="#"><i class="fa fa-store"></i> Sản phẩm</a></li>
                    <li><a href="indexgiohang.php"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
                    <li><a href="#"><i class="fa fa-phone"></i> Liên hệ</a></li>
                </ul>
            </nav>
        </div>
    </header>
<a href="indexbanhang.php" class="back-button">← Quay lại</a>
    <!-- Danh mục Áo Polo -->
    <h1 style="text-align: center; margin-top: 20px;">Sản phẩm Quần nỉ</h1>
    <div class="product-grid">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <img src="img/<?= htmlspecialchars($product['anh']) ?>" alt="<?= htmlspecialchars($product['ten']) ?>">
                    <h3><?= htmlspecialchars($product['ten']) ?></h3>
                    <p><?= number_format($product['gia'], 0, ',', '.') ?>₫</p>

                    <?php if ((int)$product['so_luong'] <= 0): ?>
                        <p style="color: red; font-weight: bold;">Hết hàng</p>
                        <button class="btn" disabled>Hết hàng</button>
                    <?php else: ?>
                        <form method="post">
                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                            <button type="submit" name="add_to_cart" class="btn">Thêm vào giỏ</button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Không có sản phẩm trong danh mục này.</p>
        <?php endif; ?>
    </div>

</body>
</html>
