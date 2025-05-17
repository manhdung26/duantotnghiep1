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
  <a href="index.php">🏠 Trang chủ</a>
  <a href="indexSP.php">👕 Sản phẩm</a>
  <a href="indexdonhang.php">📦 Đơn hàng</a>
  <a href="indexKH.php">👤 Khách hàng</a>
  <a href="indexDT.php">📈 Doanh thu</a>
</div>

<div class="main-content">
  <h1>Danh sách khách hàng</h1>
  <a href="indexthemkhachhang.php" class="btn-add">Thêm khách hàng</a>
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
                    $email = $row['email'];
                    $soDienThoai = $row['so_dien_thoai'];

                    // Kiểm tra điều kiện email và số điện thoại
                    if (substr($email, -10) === '@gmail.com' && substr($soDienThoai, 0, 1) === '0') {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['ten_khach_hang'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['so_dien_thoai'] . "</td>";
                        echo "<td>" . $row['dia_chi'] . "</td>";
                        echo "<td><a href='indexsuakhachhang.php?id=" . $row['id'] . "' class='btn-action edit'>Sửa</a>
                                  <a href='indexxoakhachhang.php?id=" . $row['id'] . "' class='btn-action delete'>Xóa</a>
                                  </td>";
                        echo "</tr>";
                    }
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
