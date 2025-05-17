<?php
// File: view/index.php
// Giả sử bạn đang truyền dữ liệu từ controller sang view như sau:
$days = $revenue_data['days'];
$revenue = $revenue_data['revenue'];
$status_counts = $order_status_data;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.8">
  <title>Fashion shop</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="daodien.css">
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
  <h2>🛍️ Fashion Shop</h2>
  <a href="index.php">🏠 Trang chủ</a>
  <a href="indexSP.php">👕 Sản phẩm</a>
  <a href="indexdonhang.php">📦 Đơn hàng</a>
  <a href="indexKH.php">👤 Khách hàng</a>
  <a href="indexDT.php">📈 Doanh thu</a>
  <a href="indexlogin.php">đăng xuất</a>
</div>

  <!-- Content -->
  <div class="content">
    <!-- Thống kê số lượng -->
    <div class="flex-card">
      <div class="card">
        <div class="card-icon">👕</div>
        <div class="card-content">
          <p class="title">Sản phẩm</p>
          <p class="value"><?php echo isset($total_sanpham) ? $total_sanpham : 0; ?></p>
        </div>
      </div>
      <div class="card">
        <div class="card-icon">📄</div>
        <div class="card-content">
          <p class="title">Đơn hàng hôm nay</p>
          <p class="value"><?php echo isset($total_donhang_ngay) ? $total_donhang_ngay : 0; ?></p>
        </div>
      </div>
      <div class="card">
        <div class="card-icon">👤</div>
        <div class="card-content">
          <p class="title">Khách hàng</p>
          <p class="value"><?php echo isset($total_customers) ? $total_customers : 0; ?></p>
        </div>
      </div>
    </div>

    <!-- Biểu đồ -->
    <div class="charts-container">
      <div class="chart-card">
        <h3 class="font-semibold text-xl p-4">Doanh thu 7 ngày qua</h3>
        <canvas id="revenueChart"></canvas>
      </div>
      <div class="chart-card">
        <h3 class="font-semibold text-xl p-4">Trạng thái đơn hàng</h3>
        <canvas id="orderStatusChart"></canvas>
      </div>
    </div>

    <!-- Đơn hàng gần đây & Top sản phẩm -->
    <div class="tables-container">
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
              <?php if (!empty($recent_orders)) : ?>
                <?php foreach ($recent_orders as $order) : ?>
                  <tr>
                    <td><?php echo $order['id'] ?? 'N/A'; ?></td>
                    <td><?php echo $order['ten_khach_hang'] ?? 'N/A'; ?></td>
                    <td><?php echo $order['ngay_dat'] ?? 'N/A'; ?></td>
                    <td><?php echo isset($order['tong_tien']) ? number_format($order['tong_tien'], 0, ',', '.') . ' đ' : 'N/A'; ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else : ?>
                <tr><td colspan="4">Chưa có đơn hàng nào.</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

      <div class="table-card">
        <h3 class="font-semibold text-xl p-4">🔥 Top sản phẩm bán chạy</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <?php
            $conn = new mysqli("localhost", "root", "", "detaitotnghiep");
            if ($conn->connect_error) {
              die("Kết nối thất bại: " . $conn->connect_error);
            }
            $sql_top = "SELECT id, ten, luot_ban, anh FROM sanpham ORDER BY luot_ban DESC LIMIT 3";
            $result_top = $conn->query($sql_top);
            if ($result_top->num_rows > 0):
              while($row = $result_top->fetch_assoc()):
          ?>
            <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition">
              <a href="chitietsanpar.php?id=<?php echo $row['id']; ?>">
                <img src="img/<?php echo $row['anh']; ?>" alt="<?php echo $row['ten']; ?>" class="w-full h-40 object-cover rounded-md mb-4">
                <h4 class="font-semibold text-lg text-gray-800 mb-2"><?php echo $row['ten']; ?></h4>
                <p class="text-gray-500"><?php echo $row['luot_ban']; ?> lượt bán</p>
              </a>
            </div>
          <?php endwhile; else: ?>
            <p>Chưa có dữ liệu sản phẩm.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Biểu đồ Doanh thu
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
    const statusColors = {
      "Hoàn thành": "#34D399",
      "Đang gửi": "#A78BFA",
      "Đã hủy": "#F87171"
    };
    const labels = <?php echo json_encode(array_keys($status_counts)); ?>;
    const dataValues = <?php echo json_encode(array_values($status_counts)); ?>;
    const backgroundColors = labels.map(label => statusColors[label] || '#9CA3AF');
    new Chart(ctxOrderStatus, {
      type: 'doughnut',
      data: {
        labels: labels,
        datasets: [{
          data: dataValues,
          backgroundColor: backgroundColors
        }]
      }
    });
  </script>
</body>
</html>
