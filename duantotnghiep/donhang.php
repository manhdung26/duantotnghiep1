<?php
// Kết nối CSDL
$conn = new mysqli("localhost", "root", "", "detaitotnghiep");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Truy vấn dữ liệu đơn hàng
$sql = "SELECT id, ten_khach_hang, id_khachhang, ngay_dat, gio_dat, tong_tien, trang_thai, phuong_thuc_thanh_toan FROM donhang ORDER BY ngay_dat DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Danh sách đơn hàng</title>
  <style> </style>
  <link rel="stylesheet" href="donhang.css">
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
  <h1>📦 Danh sách đơn hàng</h1>
  
  <a href="them_donhang.php" class="btn-add">+ Thêm đơn hàng</a>

  <table>
    <thead>
        <tr>
            <th>Mã đơn hàng</th>
            <th>Tên khách hàng</th>
            <th>ID Khách hàng</th> <!-- Thêm cột ID Khách hàng -->
            <th>Ngày đặt</th>
            <th>Giờ đặt</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
    <?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['ten_khach_hang'] . "</td>";
        echo "<td>" . (isset($row['id_khachhang']) ? $row['id_khachhang'] : 'N/A') . "</td>";
        echo "<td>" . $row['ngay_dat'] . "</td>";
        echo "<td>" . $row['gio_dat'] . "</td>";
        echo "<td><a href='chitiet_donhang.php?id=" . $row['id'] . "'>" . number_format($row['tong_tien'], 0, ',', '.') . "₫</a></td>";
        
        // Thêm class trạng thái tương ứng
        echo "<td class='status ";
        // Hiển thị trạng thái tương ứng
        if ($row['trang_thai'] == 'Đang gửi') echo "dang-gui";
                elseif ($row['trang_thai'] == 'Hoàn thành') echo "hoan-thanh";
                elseif ($row['trang_thai'] == 'Đã hủy') echo "da-huy";
                elseif ($row['trang_thai'] == 'Đã thanh toán') echo "da-thanh-toan";
                echo "'>" . $row['trang_thai'] . "</td>";
        echo "<td class='actions'>
                 <a href='sua_donhang.php?id=" . $row['id'] . "' class='edit'>Sửa</a>
                 <a href='xoa_donhang.php?id=" . $row['id'] . "' class='delete' onclick=\"return confirm('Xác nhận xóa đơn hàng?')\">Xóa</a>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8'>Không có đơn hàng</td></tr>";
}
?>
    </tbody>
  </table>
</div>
</body>
</html>

<?php
$conn->close();
?>