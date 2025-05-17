<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Danh sách sản phẩm</title>
<link rel="stylesheet" href="sanpham.css">
<style>
 body {
  margin: 0;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background-color: #f4f6f8;
  display: flex;
}

/* Sidebar */
.sidebar {
  width: 220px;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;
  background: linear-gradient(135deg, #2c3e50, #34495e);
  padding: 30px 20px;
  box-sizing: border-box;
  color: #ecf0f1;
  display: flex;
  flex-direction: column;
}

.sidebar h2 {
  font-size: 22px;
  font-weight: bold;
  margin-bottom: 30px;
  text-align: center;
  color: #ffffff;
}

.sidebar a {
  font-size: 15px;
  color: #ecf0f1;
  text-decoration: none;
  padding: 10px 12px;
  border-radius: 6px;
  margin-bottom: 10px;
  display: flex;
  align-items: center;
  gap: 8px;
  transition: background 0.3s, color 0.3s;
}

.sidebar a:hover {
  background-color: #1abc9c;
  color: #fff;
}

/* Main */
main {
  margin-left: 240px;
  padding: 40px 50px;
  flex-grow: 1;
  background-color: #f4f6f8;
}

/* Header */
h2 {
  font-size: 26px;
  color: #2c3e50;
  margin-bottom: 20px;
}

/* Filter */
.filter-form {
  margin-bottom: 25px;
}

.filter-form input[type="text"],
.filter-form select {
  padding: 8px 12px;
  border: 1px solid #ccc;
  border-radius: 6px;
  margin-right: 10px;
  font-size: 14px;
  width: 180px;
}

.filter-form button {
  padding: 8px 16px;
  border: none;
  background-color: #3498db;
  color: #fff;
  border-radius: 5px;
  font-weight: bold;
  cursor: pointer;
  transition: 0.3s;
}

.filter-form button:hover {
  background-color: #2980b9;
}

/* Add Button */
.btn-add {
  display: inline-block;
  padding: 10px 20px;
  margin-bottom: 20px;
  border: 2px solid #2ecc71;
  border-radius: 5px;
  font-size: 15px;
  color: #2ecc71;
  background-color: #fff;
  font-weight: bold;
  text-decoration: none;
  transition: 0.3s;
}

.btn-add:hover {
  background-color: #2ecc71;
  color: #fff;
}

/* Table */
table {
  width: 100%;
  border-collapse: collapse;
  background-color: #fff;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
  border-radius: 8px;
  overflow: hidden;
}

th, td {
  padding: 14px 12px;
  border-bottom: 1px solid #eee;
  text-align: left;
  font-size: 14px;
}

th {
  background-color: #f8f8f8;
  color: #34495e;
  font-weight: 600;
}

td img {
  width: 60px;
  height: auto;
  border-radius: 5px;
}

tr:hover {
  background-color: #f1f1f1;
}

/* Actions */
.action-links a {
  padding: 6px 12px;
  font-size: 13px;
  font-weight: bold;
  text-decoration: none;
  border-radius: 4px;
  transition: 0.3s;
}

.edit {
  color: #f39c12;
  border: 1px solid #f39c12;
  margin-right: 6px;
}

.edit:hover {
  background-color: #f39c12;
  color: white;
}

.delete {
  color: #e74c3c;
  border: 1px solid #e74c3c;
}

.delete:hover {
  background-color: #e74c3c;
  color: white;
}

  
</style>
</head>
<body>
  
<div class="sidebar">
  <h2>🛍️ Fashion Shop</h2>
  <a href="index.php">🏠 Trang chủ</a>
  <a href="indexSP.php">👕 Sản phẩm</a>
  <a href="indexdonhang.php">📦 Đơn hàng</a>
  <a href="indexKH.php">👤 Khách hàng</a>
  <a href="indexDT.php">📈 Doanh thu</a>
</div>

<main>
  <h2>📦 Danh sách sản phẩm</h2>

  <form method="get" class="filter-form">
    <input type="text" name="search" placeholder="Tìm theo tên..." value="<?= htmlspecialchars($search) ?>">
    <select name="status">
      <option value="">-- Tất cả tình trạng --</option>
      <option value="conhang" <?= $status == 'conhang' ? 'selected' : '' ?>>Còn hàng</option>
      <option value="hethang" <?= $status == 'hethang' ? 'selected' : '' ?>>Hết hàng</option>
    </select>
    <!-- Thêm dropdown danh mục -->
  <select name="category">
    <option value="">-- Tất cả danh mục --</option>
    <?php foreach ($categories as $dm): ?>
      <option value="<?= $dm['id'] ?>" <?= ($category == $dm['id']) ? 'selected' : '' ?>>
        <?= htmlspecialchars($dm['ten_danhmuc']) ?>
      </option>
    <?php endforeach; ?>
  </select>
    <button type="submit">🔍 Lọc</button>
  </form>

  <a href="indexthemsanpham.php" class="btn-add">➕ Thêm sản phẩm</a>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Ảnh</th>
        <th>Tên</th>
        <th>Giá</th>
        <th>Số lượng</th>
        <th>Đã bán</th>
        <th>Nổi bật</th>
        <th>Hành động</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($sanphams)): ?>
        <?php foreach ($sanphams as $row): ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td>
            <!-- Hiển thị ảnh trong cả dạng lưới và bảng -->
            <div style="display: flex; flex-direction: column; align-items: center;">
              <a href="indexchitietsanpham.php?id=<?= $row['id'] ?>">
                <img src="img/<?= $row['anh'] ?>" alt="<?= $row['ten'] ?>" style="width: 60px; height: auto; border-radius: 6px;">
              </a>
            </div>
          </td>
            <td><?= htmlspecialchars($row['ten']) ?></td>
            <td style="color: #e74c3c; font-weight: bold;"><?= number_format($row['gia'], 0, ',', '.') ?>₫</td>
            <td><?= $row['so_luong'] == 0 ? '<span style="color: red;">Hết hàng</span>' : $row['so_luong'] ?></td>
            <td style="color: #d40b0b;"><?= $row['luot_ban'] ?></td>
            <td><?= $row['noi_bat'] == 1 ? '<span class="highlight">🌟</span>' : '-' ?></td>
            <td class="action-links">
              <a href="indexsua_sanpham.php?id=<?= $row['id'] ?>" class="edit">Sửa</a> |
              <a href="indexxoa_sanpham.php?id=<?= $row['id'] ?>" class="delete" onclick="return confirm('Bạn chắc chắn muốn xóa sản phẩm này?');">Xóa</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="8">Không có sản phẩm nào phù hợp.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</main>

</body>
</html> 