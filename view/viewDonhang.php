<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Danh sách đơn hàng</title>
  <style>
   body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    display: flex;
  }
  
  /* Sidebar */
  .sidebar {
    width: 220px;
    background: linear-gradient(135deg, #2c3e50, #34495e);
    height: 100vh;
    padding: 30px 20px;
    color: #fff;
    position: fixed;
    top: 0;
    left: 0;
    box-shadow: 2px 0 6px rgba(0, 0, 0, 0.1);
  }
  
  .sidebar h2 {
    font-size: 24px;
    margin-bottom: 40px;
    color: #fff;
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
  .main-content {
    flex-grow: 1;
    padding: 40px;
    margin-left: 240px; /* Để tránh bị che khuất bởi sidebar */
  }
  
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #fff;
  }
  
  table, th, td {
    border: 1px solid #ddd;
  }
  
  th, td {
    padding: 10px;
    text-align: left;
  }
  
  th {
    background-color: #f2f2f2;
  }
  
  .status {
    font-weight: bold;
  }
  
  /* Trạng thái "Đang gửi" */
  .status.dang-gui {
  color: #f39c12;  /* Màu vàng cho "Đang gửi" */
  }
  
  /* Trạng thái "Hoàn thành" */
  .status.hoan-thanh {
  color: #2ecc71;  /* Màu xanh lá cho "Hoàn thành" */
  }
  
  /* Trạng thái "Đã hủy" */
  .status.da-huy {
  color: #e74c3c;  /* Màu đỏ cho "Đã hủy" */
  }
   /* Định dạng cho các nút Sửa và Xóa */
   .edit {
    background-color: #3498db; /* Màu nền xanh dương cho nút Sửa */
    color: white;
    padding: 8px 16px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
    transition: all 0.3s ease;
  }
  
  .delete {
    background-color: #e74c3c; /* Màu nền đỏ cho nút Xóa */
    color: white;
    padding: 8px 16px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
    transition: all 0.3s ease;
  }
  
  /* Hiệu ứng hover cho các nút Sửa và Xóa */
  .edit:hover {
    background-color: #2980b9; /* Sáng hơn khi hover */
  }
  
  .delete:hover {
    background-color: #c0392b; /* Sáng hơn khi hover */
  }
  
  /* Hiệu ứng hover chung cho tất cả các nút */
  .btn-action:hover {
    opacity: 0.8; /* Giảm độ mờ khi hover */
  }
  
  /* Định dạng cho nút Thêm đơn hàng */
  .btn-add {
    display: inline-block;
    padding: 12px 24px;
    margin-top: 30px;
    background-color: white;
    color: rgb(9, 229, 38); /* Màu chữ xanh lá */
    border: 2px solid #0bdb5e; /* Viền xanh đậm */
    border-radius: 8px;
    font-weight: bold;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2); /* Đổ bóng nhẹ */
  }
  
  /* Hiệu ứng hover cho nút Thêm đơn hàng */
  .btn-add:hover {
  background-color: #2ecc71; /* Màu nền xanh khi hover */
    color: #fff; /* Màu chữ trắng khi hover */
  }
  .status.da-thanh-toan {
    color: #2196f3;
    font-weight: bold;
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
<div class="main-content">
  <h1>📦 Danh sách đơn hàng</h1>
  
  <a href="indexthemdonhang.php" class="btn-add">+ Thêm đơn hàng</a>

  <table>
    <thead>
        <tr>
            <th>Mã đơn hàng</th>
            <th>Tên khách hàng</th>
            <th>ID Khách hàng</th>
            <th>Ngày đặt</th>
            <th>Giờ đặt</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
    <?php
    if ($orders->num_rows > 0) {
        while ($row = $orders->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['ten_khach_hang'] . "</td>";
            echo "<td>" . (isset($row['id_khachhang']) ? $row['id_khachhang'] : 'N/A') . "</td>";
            echo "<td>" . $row['ngay_dat'] . "</td>";
            echo "<td>" . $row['gio_dat'] . "</td>";
            echo "<td><a href='indexchitiet_donhang.php?id=" . $row['id'] . "'>" . number_format($row['tong_tien'], 0, ',', '.') . "₫</a></td>";
            
            // Thêm class trạng thái tương ứng
            echo "<td class='status ";
            // Hiển thị trạng thái tương ứng
            if ($row['trang_thai'] == 'Đang gửi') echo "dang-gui";
            elseif ($row['trang_thai'] == 'Hoàn thành') echo "hoan-thanh";
            elseif ($row['trang_thai'] == 'Đã hủy') echo "da-huy";
            elseif ($row['trang_thai'] == 'Đã thanh toán') echo "da-thanh-toan";
            echo "'>" . $row['trang_thai'] . "</td>";
            echo "<td class='actions'>
                     <a href='indexsuadonhang.php?id=" . $row['id'] . "' class='edit'>Sửa</a>
                     <a href='indexxoadonhang.php?id=" . $row['id'] . "' class='delete' onclick=\"return confirm('Xác nhận xóa đơn hàng?')\">Xóa</a>
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
