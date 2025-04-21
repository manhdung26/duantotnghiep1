<?php
$conn = new mysqli("localhost", "root", "", "detaitotnghiep");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$id_donhang = $_GET['id'];

// Lấy thông tin sản phẩm trong đơn hàng
$sql = "SELECT sp.ten, sp.anh, dssp.so_luong, sp.gia 
        FROM donhang_sanpham dssp
        JOIN sanpham sp ON dssp.id_sanpham = sp.id
        WHERE dssp.id_donhang = $id_donhang";
$result = $conn->query($sql);

// Lấy thông tin đơn hàng (tổng tiền, phương thức thanh toán)
$sql_info = "SELECT tong_tien, phuong_thuc_thanh_toan FROM donhang WHERE id = $id_donhang";
$info_result = $conn->query($sql_info);
$donhang_info = $info_result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Chi tiết đơn hàng</title>
  <link rel="stylesheet" href="donhang.css">
  <style>
    .product-image {
      width: 80px;
      height: auto;
      border-radius: 8px;
    }
    .info-box {
      margin: 20px 0;
      padding: 10px;
      background: #f4f4f4;
      border-left: 5px solid #888;
      width: fit-content;
    }
  .info-box-row {
  display: flex;
  justify-content: space-between;
  gap: 20px;
  margin-top: 20px;
  }

  .info-box {
  padding: 10px;
  background: #f4f4f4;
  border-left: 5px solid #888; 
  min-width: 250px;
  }
  </style>
</head>
<body>

<div class="main-content">
  <h1>🛒 Chi tiết đơn hàng #<?php echo $id_donhang; ?></h1>
  <a href="donhang.php" class="btn-back">⬅ Quay lại</a>

  <table>
    <thead>
        <tr>
            <th>Ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
        </tr>
    </thead>
    <tbody>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><img src='img/" . $row['anh'] . "' class='product-image'></td>";
            echo "<td>" . $row['ten'] . "</td>";
            echo "<td>" . $row['so_luong'] . "</td>";
            echo "<td>" . number_format($row['gia'], 0, ',', '.') . "₫</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Không có sản phẩm trong đơn hàng này.</td></tr>";
    }
    ?>
    </tbody>
  </table>

  <?php if ($donhang_info): ?>
  <div class="info-box-row">
    <div class="info-box">
      <p><strong>💳 Phương thức thanh toán:</strong> <?php echo $donhang_info['phuong_thuc_thanh_toan']; ?></p>
    </div>
    <div class="info-box">
      <p><strong>🧾 Tổng tiền:</strong> <?php echo number_format($donhang_info['tong_tien'], 0, ',', '.'); ?>₫</p>
    </div>
  </div>
<?php endif; ?>

</div>
</body>
</html>
<?php
$conn->close();
?>
