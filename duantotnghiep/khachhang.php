<?php
// Kết nối CSDL
$conn = new mysqli("localhost", "root", "", "detaitotnghiep");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Truy vấn dữ liệu khách hàng
$sql = "SELECT * FROM khachhang ORDER BY ngay_dang_ky DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Danh sách khách hàng</title>
  <link rel="stylesheet" href="khachhang.css">
</head>
<body>

<div class="sidebar">
  <h2>🛍️ Fashion Shop</h2>
  <a href="daodien.php">🏠 Trang chủ</a>
  <a href="sanpham.php">👕 Sản phẩm</a>
  <a href="donhang.php">📦 Đơn hàng</a>
  <a href="khachhang.php">👤 Khách hàng</a>
  <a href="doanhthu.php">📈 Doanh thu</a>
</div>

<div class="main-content">
  <h1>Danh sách khách hàng</h1>
  <a href="themkhachhang.php" class="btn-add">Thêm khách hàng</a>
  <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Khách Hàng</th>
                <th>Email</th>
                <th>Số Điện Thoại</th>
                <th>Địa Chỉ</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['ten_khach_hang'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['so_dien_thoai'] . "</td>";
                    echo "<td>" . $row['dia_chi'] . "</td>";
                    echo "<td><a href='suakhachhang.php?id=" . $row['id'] . "' class='btn-action edit'>Sửa</a>
                              <a href='xoakhachhang.php?id=" . $row['id'] . "' class='btn-action delete'>Xóa</a>
                              </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Không có khách hàng nào</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php $conn->close(); ?>
