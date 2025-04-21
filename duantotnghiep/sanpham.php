<?php
// Kết nối CSDL
$conn = new mysqli("localhost", "root", "", "detaitotnghiep");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Truy vấn dữ liệu sản phẩm
$sql = "SELECT * FROM sanpham ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Danh sách sản phẩm</title>
  <link rel="stylesheet" href="sanpham.css">
</head>
<body>

<div class="sidebar">
  <h1>🛍️ Fashion Shop</h1>
  <a href="daodien.php">🏠 Trang chủ</a>
  <a href="sanpham.php">👕 Sản phẩm</a>
  <a href="donhang.php">📦 Đơn hàng</a>
  <a href="khachhang.php">👤 Khách hàng</a>
  <a href="doanhthu.php">📈 Doanh thu</a>
</div>

<main>
  <h2 class="page-title">📦 Danh sách sản phẩm</h2>
  <a href="them_sanpham.php" class="btn-add">➕ Thêm sản phẩm</a>
  <div class="product-grid">
  <?php if ($result->num_rows > 0): ?>
    <?php while($row = $result->fetch_assoc()): ?>
      <div class="product">
        <a href="chitietsanpar.php?id=<?php echo $row['id']; ?>">
        <img src="img/<?php echo $row['anh']; ?>" alt="<?php echo $row['ten']; ?>">
        <h3><?php echo $row['ten']; ?></h3>
        <?php if ($row['noi_bat'] == 1): ?>
        <span class="highlight-label">🌟 Nổi bật</span>
        <?php endif; ?>
        <div class="price">
  <?php echo number_format($row['gia'], 0, ',', '.') . "₫"; ?>
</div>
<div class="stock-info">
  <?php if ($row['so_luong'] == 0): ?>
    <div class="stock-item">
      <span class="out-of-stock" title="Hết hàng"></span>
      <span class="stock-text">Hết hàng</span>
    </div>
  <?php else: ?>
    <div class="stock-item stock-text">Còn lại: <?php echo $row['so_luong']; ?></div>
  <?php endif; ?>

  <div class="stock-item sold-count">Đã bán: <?php echo $row['luot_ban']; ?></div>
</div>

        <!-- Nút Sửa và Xóa -->
        <div class="product-actions">
          <a href="sua_sanpham.php?id=<?php echo $row['id']; ?>" class="btn-action edit">Sửa</a>
          <a href="xoa_sanpham.php?id=<?php echo $row['id']; ?>" class="btn-action delete" onclick="return confirm('Bạn chắc chắn muốn xóa sản phẩm này?');">Xóa</a>
        </div>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p>Không có sản phẩm nào.</p>
  <?php endif; ?>
  </div>
</main>

</body>
</html>

<?php
$conn->close();
?>
