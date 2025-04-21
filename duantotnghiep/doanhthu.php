<?php
// Kết nối CSDL
$conn = new mysqli("localhost", "root", "", "detaitotnghiep");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy dữ liệu doanh thu theo tháng
$sql = "SELECT MONTH(ngay_dat) AS thang, SUM(tong_tien) AS tong
        FROM donhang
        WHERE trang_thai = 'Hoàn thành'
        GROUP BY MONTH(ngay_dat)
        ORDER BY thang";
$result = $conn->query($sql);

$labels = [];
$data = [];

while ($row = $result->fetch_assoc()) {
    $labels[] = "Tháng " . $row['thang'];
    $data[] = $row['tong'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Doanh thu theo thời gian</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style></style>
  <link rel="stylesheet" href="doanhthu.css">
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
