<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Doanh thu theo thời gian</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="doanhthu.css">
</head>
<body>

<div class="sidebar">
  <h2>🛍️ Fashion Shop</h2>
  <a href="index.php">🏠 Trang chủ</a>
  <a href="index.php?controller=sanpham">👕 Sản phẩm</a>
  <a href="index.php?controller=donhang">📦 Đơn hàng</a>
  <a href="index.php?controller=khachhang">👤 Khách hàng</a>
  <a href="index.php?controller=doanhthu">📈 Doanh thu</a>
</div>

<div class="main-content">
  <h1>Biểu đồ doanh thu theo tháng</h1>
  <canvas id="revenueChart" width="1000" height="500"></canvas>
</div>

<script>
  const ctx = document.getElementById('revenueChart').getContext('2d');
  const revenueChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?= json_encode($labels) ?>,
      datasets: [{
        label: 'Doanh thu (VNĐ)',
        data: <?= json_encode($data) ?>,
        backgroundColor: 'rgba(75, 192, 192, 0.7)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: function(value) {
              return value.toLocaleString('vi-VN') + '₫';
            }
          }
        }
      }
    }
  });
</script>

</body>
</html>
