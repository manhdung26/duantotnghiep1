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
  <a href="indexdonhang.php" class="btn-back">⬅ Quay lại</a>

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
    if ($sanphams && $sanphams->num_rows > 0) {
        while($row = $sanphams->fetch_assoc()) {
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
    <p><strong>💳 Trạng thái thanh toán:</strong> 
<?php 
    if ($donhang_info['phuong_thuc_thanh_toan'] == 'Thanh toán ngay') {
        echo "Đã thanh toán";
    } else {
        echo $donhang_info['phuong_thuc_thanh_toan'];
    }
?>
</p>

    </div>
    <div class="info-box">
      <p><strong>🧾 Tổng tiền:</strong> <?php echo number_format($donhang_info['tong_tien'], 0, ',', '.'); ?>₫</p>
    </div>
  </div>
<?php endif; ?>

</div>
</body>
</html>