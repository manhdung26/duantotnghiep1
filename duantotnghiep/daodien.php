<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "detaitotnghiep"; // Đổi thành tên database của bạn

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Đếm tổng số sản phẩm
$result_sanpham = $conn->query("SELECT COUNT(*) AS tong_so_san_pham FROM sanpham");
if ($result_sanpham) {
    $row_sanpham = $result_sanpham->fetch_assoc();
    $total_sanpham = $row_sanpham['tong_so_san_pham'];
} else {
    $total_sanpham = 0;
}

// Đếm đơn hàng hôm nay
$ngay = date('Y-m-d');
$result_donhang_ngay = $conn->query("SELECT COUNT(*) AS tong_so_don_hang_hom_nay FROM donhang WHERE DATE(ngay_dat) = '$ngay'");
if ($result_donhang_ngay) {
    $row_donhang_ngay = $result_donhang_ngay->fetch_assoc();
    $total_donhang_ngay = $row_donhang_ngay['tong_so_don_hang_hom_nay'];
} else {
    $total_donhang_ngay = 0;
}

// Đếm tổng số khách hàng
$result_customers = $conn->query("SELECT COUNT(*) AS tong_so_khach_hang FROM khachhang");
if ($result_customers) {
    $row_customers = $result_customers->fetch_assoc();
    $total_customers = $row_customers['tong_so_khach_hang'];
} else {
    $total_customers = 0;
}

// Doanh thu 7 ngày qua
$revenue = [];
$days = [];
for ($i = 6; $i >= 0; $i--) {
    $day = date('Y-m-d', strtotime("-$i days"));
    $days[] = date('D', strtotime($day)); // Mon, Tue, ...
    $query = "SELECT SUM(tong_tien) as daily_revenue FROM donhang WHERE DATE(ngay_dat) = '$day'";
    $res = $conn->query($query);
    $row = $res->fetch_assoc();
    $revenue[] = $row['daily_revenue'] ? $row['daily_revenue'] : 0;
}

// Thống kê trạng thái đơn hàng
$result_status = $conn->query("SELECT trang_thai, COUNT(*) as count FROM donhang GROUP BY trang_thai");
$status_counts = [];
while ($row = $result_status->fetch_assoc()) {
    $status_counts[$row['trang_thai']] = $row['count'];
}

// Lấy đơn hàng gần đây
$recent_orders = [];
$result_recent_orders = $conn->query("SELECT donhang.id, donhang.ngay_dat, khachhang.ten_khach_hang, donhang.tong_tien 
                                      FROM donhang
                                      JOIN khachhang ON donhang.id_khachhang = khachhang.id
                                      ORDER BY donhang.ngay_dat DESC LIMIT 5");

while ($row = $result_recent_orders->fetch_assoc()) {
    $recent_orders[] = $row;
}

// Lấy top sản phẩm bán chạy
$top_products = [];
$result_top_products = $conn->query("SELECT sanpham.ten, SUM(donhang_sanpham.so_luong) AS total_sold
                                     FROM donhang_sanpham
                                     JOIN sanpham ON donhang_sanpham.id = sanpham.id
                                     GROUP BY sanpham.ten
                                     ORDER BY total_sold DESC LIMIT 5");

while ($row = $result_top_products->fetch_assoc()) {
    $top_products[] = $row;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.8">
  <title>Fashion shop</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
  body {
    font-family: 'Arial', sans-serif;
    display: flex;
    margin: 0;
    padding: 0;
    font-size: 14px;
    background-color: #f9fafb;
  }

  .sidebar {
    width: 16.67%;
    background-color: #1f2937;
    color: white;
    padding-top: 30px;
    position: fixed;
    height: 100%;
    font-size: 16px;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
  }

  .sidebar h2 {
    text-align: center;
    font-size: 22px;
    font-weight: bold;
    margin-bottom: 40px;
    color: #fff;
  }

  .sidebar a {
    display: block;
    padding: 12px 20px;
    text-decoration: none;
    color: #cbd5e0;
    transition: background-color 0.3s, color 0.3s;
    border-left: 4px solid transparent;
  }

  .sidebar a:hover {
    background-color: #374151;
    color: #fff;
    border-left: 4px solid #3b82f6;
  }

  .content {
    margin-left: 16.67%;
    padding: 30px;
    width: 83.33%;
    overflow-x: hidden;
    background-color: #f9fafb;
  }

  .flex-card {
    display: flex;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 30px;
  }

  .card {
    flex: 1;
    background-color: white;
    border-radius: 16px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    padding: 20px;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 120px;
    transition: transform 0.2s;
  }

  .card:hover {
    transform: translateY(-5px);
  }

  .card-icon {
    font-size: 2.5rem;
    margin-right: 15px;
  }

  .card-content {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
  }

  .card-content p {
    margin: 0;
  }

  .card-content .title {
    font-size: 1rem;
    font-weight: 600;
    color: #6b7280;
  }

  .card-content .value {
    font-size: 1.5rem;
    font-weight: bold;
    color: #111827;
  }

  .charts-container {
    display: flex;
    gap: 20px;
    margin-bottom: 30px;
  }

  .chart-card {
    flex: 1;
    background-color: white;
    border-radius: 16px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    padding: 20px;
  }

  .tables-container {
    display: flex;
    gap: 20px;
  }

  .table-card {
    flex: 1;
    background-color: white;
    border-radius: 16px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    padding: 20px;
  }

  .table-wrapper {
    overflow-x: auto;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
  }

  th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #e5e7eb;
  }

  th {
    background-color: #f3f4f6;
    font-weight: 600;
    color: #374151;
  }

  tr:hover {
    background-color: #f9fafb;
  }

  /* Top sản phẩm bán chạy */
  .top-product-list {
    list-style-type: decimal;
    padding-left: 20px;
    margin-top: 10px;
  }

  .top-product-list li {
    margin-bottom: 10px;
  }

  .top-product-list a {
    text-decoration: none;
    color: #1f2937;
    font-weight: 500;
  }

  .top-product-list a:hover {
    text-decoration: underline;
    color: #3b82f6;
  }

  canvas {
    width: 100% !important;
    height: auto !important;
  }
</style>

</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <h2>🛍️ Fashion Shop</h2>
    <a href="daodien.php">🏠 Trang chủ</a>
    <a href="sanpham.php">👕 Sản phẩm</a>
    <a href="donhang.php">📦 Đơn hàng</a>
    <a href="khachhang.php">👤 Khách hàng</a>
    <a href="doanhthu.php">📈 Doanh thu</a>
  </div>

  <!-- Content -->
  <div class="content">
    <!-- Các phần Sản phẩm, Đơn hàng hôm nay, Khách hàng -->
    <div class="flex-card">
      <!-- Sản phẩm -->
      <div class="card">
        <div class="card-icon">👕</div>
        <div class="card-content">
          <p class="title">Sản phẩm</p>
          <p class="value"><?php echo $total_sanpham; ?></p>
        </div>
      </div>

      <!-- Đơn hàng hôm nay -->
      <div class="card">
        <div class="card-icon">📄</div>
        <div class="card-content">
          <p class="title">Đơn hàng hôm nay</p>
          <p class="value"><?php echo $total_donhang_ngay; ?></p>
        </div>
      </div>

      <!-- Khách hàng -->
      <div class="card">
        <div class="card-icon">👤</div>
        <div class="card-content">
          <p class="title">Khách hàng</p>
          <p class="value"><?php echo $total_customers; ?></p>
        </div>
      </div>
    </div>

    <!-- Biểu đồ Doanh thu và Biểu đồ Trạng thái đơn hàng nằm ngang -->
    <div class="charts-container">
      <!-- Biểu đồ Doanh thu -->
      <div class="chart-card">
        <h3 class="font-semibold text-xl p-4">Doanh thu 7 ngày qua</h3>
        <canvas id="revenueChart"></canvas>
      </div>

      <!-- Biểu đồ Trạng thái đơn hàng -->
      <div class="chart-card">
        <h3 class="font-semibold text-xl p-4">Trạng thái đơn hàng</h3>
        <canvas id="orderStatusChart"></canvas>
      </div>
    </div>

    <!-- Đơn hàng gần đây và Top sản phẩm bán chạy nằm ngang -->
    <div class="tables-container">
      <!-- Đơn hàng gần đây -->
      <div class="table-card">
        <h3 class="font-semibold text-xl p-4">Đơn hàng gần đây</h3>
        <div class="table-wrapper">
          <table>
            <thead>
              <tr>
                <th>Mã đơn hàng</th>
                <th>Khách hàng</th>
                <th>Ngày đặt</th>
                <th>Tổng tiền</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($recent_orders as $order): ?>
                <tr>
                  <td><?php echo $order['id']; ?></td>
                  <td><?php echo $order['ten_khach_hang']; ?></td>
                  <td><?php echo $order['ngay_dat']; ?></td>
                  <td><?php echo number_format($order['tong_tien'], 0, ',', '.'); ?> đ</td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
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
            <tbody>
              <?php foreach ($top_products as $product): ?>
                <tr>
                  <td><?php echo $product['ten_san_pham']; ?></td>
                  <td><?php echo $product['total_sold']; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>

  <script>
    // Biểu đồ Doanh thu 7 ngày
    const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctxRevenue, {
      type: 'bar',
      data: {
        labels: <?php echo json_encode($days); ?>,
        datasets: [{
          label: 'Doanh thu',
          data: <?php echo json_encode($revenue); ?>,
          backgroundColor: '#60A5FA'
        }]
      }
    });

    // Biểu đồ Trạng thái đơn hàng
    const ctxOrderStatus = document.getElementById('orderStatusChart').getContext('2d');
    new Chart(ctxOrderStatus, {
      type: 'doughnut',
      data: {
        labels: <?php echo json_encode(array_keys($status_counts)); ?>,
        datasets: [{
          data: <?php echo json_encode(array_values($status_counts)); ?>,
          backgroundColor: ['#34D399', '#A78BFA', '#F87171']
        }]
      }
    });
  </script>
</body>
</html>
