<?php
// Kết nối CSDL
$conn = new mysqli("localhost", "root", "", "detaitotnghiep");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Truy vấn dữ liệu sản phẩm
$sql = "SELECT * FROM sanpham ORDER BY id DESC";
$result = $conn->query($sql);

// Kiểm tra kết quả truy vấn
if (!$result) {
    die("Truy vấn không thành công: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Danh sách sản phẩm</title>
  <style>
   * {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  height: 100vh;
  overflow-y: auto;  /* Cho phép cuộn dọc */
  background-color: #f4f7fa;  /* Màu nền sáng cho toàn trang */
}

.sidebar {
  width: 240px;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;
  background-color: #34495e;
  color: white;
  padding: 30px 20px;
  box-shadow: 2px 0 6px rgba(0, 0, 0, 0.1);
}

.sidebar h1 {
  font-size: 24px;
  margin-bottom: 40px;
  text-align: center;
}

.sidebar a {
  display: block;
  color: #ecf0f1;
  text-decoration: none;
  margin: 16px 0;
  font-size: 18px;
  padding: 10px;
  border-radius: 8px;
  transition: background 0.3s, color 0.3s;
}

.sidebar a:hover {
  background-color: #1abc9c;
  color: #fff;
}

/* Main content */
main {
  margin-left: 260px;
  padding: 40px;
  background-color: #fff;
  height: 100%;
  overflow-y: auto; /* Cho phép cuộn khi nội dung nhiều */
}

h2.page-title {
  font-size: 32px;
  margin-bottom: 30px;
  color: #2c3e50;
}

/* Cấu trúc grid cho sản phẩm */
.product-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 25px;
}

@media (max-width: 1200px) {
  .product-grid {
    grid-template-columns: repeat(3, 1fr); /* 3 cột khi màn hình nhỏ */
  }
}

@media (max-width: 900px) {
  .product-grid {
    grid-template-columns: repeat(2, 1fr); /* 2 cột khi màn hình rất nhỏ */
  }
}

@media (max-width: 600px) {
  .product-grid {
    grid-template-columns: 1fr; /* 1 cột cho màn hình di động */
  }
}

.product {
  background: #fff;
  border-radius: 12px;
  padding: 20px;
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.06);
  text-align: center;
  transition: transform 0.25s ease, box-shadow 0.25s ease;
  display: block;
  height: 100%;
  overflow: hidden;
}

.product:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.product img {
  width: 100%;
  height: 180px;
  object-fit: cover;
  border-radius: 8px;
  margin-bottom: 12px;
}

.product h3 {
  font-size: 18px;
  color: #333;
  margin: 10px 0 8px;
}

.product p {
  font-size: 14px;
  color: #777;
  min-height: 36px;
}

.price {
  color: #e74c3c;
  font-weight: bold;
  font-size: 16px;
  margin-top: 10px;
}

.product-actions {
  margin-top: 10px;
}

.btn-action {
  padding: 5px 10px;
  margin: 0 5px;
  border-radius: 5px;
  text-decoration: none;
  color: white;
  font-weight: bold;
}

.edit {
  background-color: #3498db;
}

.delete {
  background-color: #e74c3c;
}

.btn-action:hover {
  opacity: 0.8;
}

.btn-add {
  display: inline-block;
  padding: 12px 24px;
  margin-top: 30px;
  background-color: white;
  color: rgb(9, 229, 38);
  border: 2px solid #0bdb5e;
  border-radius: 8px;
  font-weight: bold;
  text-decoration: none;
  transition: all 0.3s ease;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
}

.btn-add:hover {
  background-color: #2ecc71;
  color: #fff;
}

.stock-info {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 15px;
  margin-top: 8px;
  font-size: 14px;
}

.stock-item {
  display: flex;
  align-items: center;
}

.stock-text {
  margin-left: 6px;
  color: pink;
}

.sold-count {
  color: #d40b0b;
}

.highlight-label {
  display: inline-block;
  background-color: gold;
  color: black;
  font-weight: bold;
  padding: 2px 6px;
  border-radius: 8px;
  margin-top: 4px;
  font-size: 14px;
}
  </style>
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
