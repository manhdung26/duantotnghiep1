<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Quản lý Shop Thời Trang</title>
  <style> 
  /* Cấu trúc chung */
  body {
    font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f5f5f5;
      color: #333;
}

    /* Thanh bên */
    .sidebar {
  width: 250px;
  height: 100vh; /* Đảm bảo thanh bên có chiều cao bằng với chiều cao của cửa sổ */
  background-color: #2c3e50;
  color: white;
  padding: 30px;
  box-sizing: border-box;
  position: fixed; /* Cố định thanh bên ở vị trí cố định */
  top: 0;
  left: 0;
  transition: all 0.3s ease;
  z-index: 1000; /* Đảm bảo thanh bên nằm trên các phần tử khác */
}

    .sidebar h2 {
      text-align: center;
      font-size: 1.8em;
      margin-bottom: 30px;
      color: #ecf0f1;
    }

    .sidebar a {
      display: block;
      color: #bdc3c7;
      padding: 15px;
      text-decoration: none;
      border-radius: 5px;
      margin-bottom: 15px;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    .sidebar a:hover {
      background-color: #34495e;
      color: white;
    }

    /* Nội dung chính */
    .main {
      margin-left: 270px;  /* Vẫn giữ khoảng cách từ sidebar */
      padding: 20px;
    }

    h1, h2 {
      color: #2c3e50;
    }

    /* Cards thống kê */
    .clearfix {
      display: flex;
      justify-content: flex-start;  /* Căn trái */
      gap: 20px; /* Giữ khoảng cách giữa các phần tử */
      margin-bottom: 30px;
    }

    .card {
      background-color: #fff;
      padding: 25px;
      width: 48%;  /* Giảm chiều rộng để không quá rộng */
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      text-align: center;
      transition: transform 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .card p {
      font-size: 1.1em;
      margin-bottom: 15px;
      color: #7f8c8d;
    }

    .card h3 {
      font-size: 2em;
      color: #27ae60;
    }

    /* Bảng thống kê đơn hàng */
    table {
      width: 100%;
      border-collapse: collapse;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    th, td {
      padding: 15px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #ecf0f1;
      font-weight: bold;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    /* Danh sách sản phẩm nổi bật */
    ul {
      list-style-type: none;
      padding-left: 0;
    }

    ul li {
      background-color: #fff;
      padding: 12px;
      border-radius: 5px;
      margin-bottom: 12px;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
      transition: background-color 0.3s ease;
    }

    ul li:hover {
      background-color: #f7f7f7;
    }

    /* Thông báo */
    .notification {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      margin-bottom: 30px;
    }

    .notification h3 {
      font-size: 1.5em;
      color: #e74c3c;
      margin-bottom: 20px;
    }

    .notification ul {
      list-style-type: none;
      padding-left: 0;
    }

    .notification li {
      margin: 10px 0;
    }

    /* Top sản phẩm bán chạy */
    ol {
      padding-left: 20px;
    }

    ol li {
      margin: 10px 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .clearfix {
        flex-direction: column;
      }

      .card {
        width: 48%;
        margin-bottom: 20px;
      }

      .sidebar {
        width: 200px;
      }

      .main {
        margin-left: 220px;
      }
    }
    .notification li a:hover {
  background-color: #f1f1f1;
  display: block;
  border-radius: 6px;
  padding: 10px;
}



  </style>
</head>
<body>
<?php
$conn = new mysqli("localhost", "root", "", "detaitotnghiep");
if ($conn->connect_error) {
  die("Kết nối thất bại: " . $conn->connect_error);
}

// Tổng đơn hàng
$sql_donhang = "SELECT COUNT(*) AS tong_donhang FROM donhang";
$result_donhang = $conn->query($sql_donhang);
$row_donhang = $result_donhang->fetch_assoc();
$tong_donhang = $row_donhang['tong_donhang'];

// Tổng sản phẩm
$sql_tong_sanpham = "SELECT COUNT(*) as total FROM sanpham";
$result_sanpham = $conn->query($sql_tong_sanpham);
$row_sanpham = $result_sanpham->fetch_assoc();
$tong_sanpham = $row_sanpham['total'];

// Lấy tổng doanh thu từ đơn hàng hoàn thành
$sql_doanhthu = "SELECT SUM(tong_tien) AS tong_doanh_thu FROM donhang WHERE trang_thai = 'Hoàn thành'";
$result = $conn->query($sql_doanhthu);
$tong_doanh_thu = 0;

if ($result && $row = $result->fetch_assoc()) {
    $tong_doanh_thu = $row['tong_doanh_thu'];
}

// Truy vấn để lấy tổng số khách hàng
$sql_count = "SELECT COUNT(*) AS total_customers FROM khachhang";
$result_count = $conn->query($sql_count);
$row_count = $result_count->fetch_assoc();
$total_customers = $row_count['total_customers'];

// Truy vấn dữ liệu khách hàng
$sql = "SELECT * FROM khachhang";
$result = $conn->query($sql);

// Lấy các đơn hàng mới (Đơn hàng có trạng thái 'Đang xử lý')
$sql_shipping_orders = "SELECT * FROM donhang WHERE trang_thai = 'Đang gửi' ORDER BY ngay_dat DESC LIMIT 1";
$result_shipping_orders = $conn->query($sql_shipping_orders);

// Lấy các sản phẩm còn dưới 10 cái
$sql_low_stock = "SELECT * FROM sanpham WHERE so_luong < 10";
$result_low_stock = $conn->query($sql_low_stock);
?>

  <div class="sidebar">
    <h2>🛍️ Fashion Shop</h2>
    <a href="daodien.php">🏠 Trang chủ</a>
  <a href="sanpham.php">👕 Sản phẩm</a>
  <a href="donhang.php">📦 Đơn hàng</a>
  <a href="khachhang.php">👤 Khách hàng</a>
  <a href="doanhthu.php">📈 Doanh thu</a>
  </div>

  <div class="main">
    <h1>Trang quản trị</h1>

    <div class="clearfix">
      <div class="card">
        <p>Đơn hàng</p>
        <h3><?php echo number_format($tong_donhang); ?></h3>
      </div>
      <div class="card">
        <p>Doanh thu</p>
        <h3><?= number_format($tong_doanh_thu, 0, ',', '.') ?>₫</h3>
      </div>
      <div class="card">
        <p>Khách hàng</p>
      <h3><?= $total_customers ?></h3>
      </div>
      <div class="card">
        <p>Sản phẩm</p>
        <h3><?php echo $tong_sanpham; ?></h3>
      </div>
    </div>

 <!-- Gộp cả Sản phẩm nổi bật và Thông báo vào 1 container flex -->
<div style="display: flex; gap: 20px; margin-bottom: 30px; justify-content: space-between;">
  <!-- Sản phẩm nổi bật -->
  <div style="flex: 1; background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 1px 4px rgba(0,0,0,0.1); box-sizing: border-box;">
    <h3>🔥 Sản phẩm nổi bật</h3>
    <?php
      $sql_top = "SELECT * FROM sanpham WHERE noi_bat = 1 ORDER BY luot_ban DESC LIMIT 4";
      $result_top = $conn->query($sql_top);

      if ($result_top->num_rows > 0):
        while($row = $result_top->fetch_assoc()):
    ?>
    <a href="chitietsanpar.php?id=<?php echo $row['id']; ?>" style="text-decoration: none; color: inherit;">
      <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; padding: 10px; border-radius: 6px; transition: background 0.2s;">
        <div style="display: flex; align-items: center;">
          <img src="img/<?php echo $row['anh']; ?>" alt="<?php echo $row['ten']; ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px; margin-right: 15px;">
          <div>
            <strong><?php echo $row['ten']; ?></strong><br>
            <span style="color: #7f8c8d;">Còn hàng: <?php echo $row['so_luong']; ?></span>
          </div>
        </div>
        <div style="font-weight: bold;"><?php echo number_format($row['gia'], 0, ',', '.') . "₫"; ?></div>
      </div>
    </a>
    <?php endwhile; endif; ?>
  </div>

  <!-- Thông báo gần đây -->
  <div style="flex: 1; background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 1px 4px rgba(0,0,0,0.1); box-sizing: border-box;">
    <h3>🔔 Thông báo gần đây</h3>
    <ul style="list-style-type: none; padding-left: 0;">
      <?php if ($result_shipping_orders->num_rows > 0): ?>
        <?php while ($row = $result_shipping_orders->fetch_assoc()): ?>
          <li><a href="donhang.php?id=<?php echo $row['id']; ?>" style="text-decoration: none; color: inherit;">📦 Đơn hàng #<?php echo $row['id']; ?> đang gửi.</a></li>
        <?php endwhile; ?>
      <?php else: ?> 
        <li>📦 Không có đơn hàng đang gửi.</li>
      <?php endif; ?>

      <?php if ($result_low_stock->num_rows > 0): ?>
        <?php while ($row = $result_low_stock->fetch_assoc()): ?>
          <li><a href="sanpham.php?id=<?php echo $row['id']; ?>" style="text-decoration: none; color: inherit;">🛒 Sản phẩm "<?php echo $row['ten']; ?>" còn dưới 10 cái.</a></li>
        <?php endwhile; ?>
      <?php else: ?>
        <li><a href="sanpham.php" style="text-decoration: none; color: inherit;">🛒 Tất cả sản phẩm đủ số lượng.</a></li>
      <?php endif; ?>
    </ul>
  </div>
</div>




<!-- Bảng đơn hàng gần đây -->
<div style="margin-bottom: 30px;">
  <h3>📋 Đơn hàng gần đây</h3>
  <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
    <thead style="background-color: #f5f5f5;">
      <tr>
        <th>Mã ĐH</th>
        <th>Khách hàng</th>
        <th>Ngày đặt</th>
        <th>Tổng tiền</th>
        <th>Trạng thái</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Truy vấn 5 đơn hàng mới nhất
      $sql_recent_orders = "SELECT donhang.id, donhang.ngay_dat, donhang.tong_tien, donhang.trang_thai, khachhang.ten_khach_hang AS ten_khach_hang
                            FROM donhang 
                           JOIN khachhang ON donhang.id_khachhang = khachhang.id 
                            ORDER BY donhang.ngay_dat DESC 
                            LIMIT 5";

      $result_recent_orders = $conn->query($sql_recent_orders);

      if ($result_recent_orders && $result_recent_orders->num_rows > 0):
        while ($row = $result_recent_orders->fetch_assoc()):
      ?>
        <tr>
          <td>#<?php echo $row['id']; ?></td>
          <td><?php echo htmlspecialchars($row['ten_khach_hang']); ?></td>
          <td><?php echo htmlspecialchars($row['ngay_dat']); ?></td>
          <td><?php echo number_format($row['tong_tien'], 0, ',', '.') . '₫'; ?></td>
          <td>
            <?php
              switch ($row['trang_thai']) {
                case 'Đang gửi': echo '⏳ Đang gửi'; break;
                case 'Hoàn thành':echo '✅ Đã giao'; break;
                case 'Đã hủy':echo '❌ Đã hủy'; break;
                default:echo htmlspecialchars($row['trang_thai']);
            }
            ?>
          </td>
        </tr>
      <?php
        endwhile;
      else:
      ?>
        <tr>
          <td colspan="5">Không có đơn hàng nào.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>



    <!-- Top sản phẩm bán chạy -->
<div style="width: 48%; background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 1px 4px rgba(0,0,0,0.1); box-sizing: border-box;">
  <h3>🔥 Top sản phẩm bán chạy</h3>
  <ol style="padding-left: 20px;">
    <?php
      // Kết nối cơ sở dữ liệu
      $conn = new mysqli("localhost", "root", "", "detaitotnghiep");
      if ($conn->connect_error) {
          die("Kết nối thất bại: " . $conn->connect_error);
      }

      // Lấy 3 sản phẩm có lượt bán cao nhất
      $sql_top = "SELECT id, ten, luot_ban FROM sanpham ORDER BY luot_ban DESC LIMIT 3";
      $result_top = $conn->query($sql_top);

      if ($result_top->num_rows > 0):
        while($row = $result_top->fetch_assoc()):
    ?>
      <li>
        <a href="chitietsanpar.php?id=<?php echo $row['id']; ?>" style="text-decoration: none; color: #2c3e50;">
          <?php echo $row['ten']; ?> - <?php echo $row['luot_ban']; ?> lượt bán
        </a>
      </li>
    <?php endwhile; else: ?>
      <li>Chưa có dữ liệu sản phẩm</li>
    <?php endif; ?>
  </ol>
</div>

  </div>



  <?php
$conn->close();
?>
</body>
</html>
