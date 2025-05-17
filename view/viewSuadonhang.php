<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Sửa đơn hàng</title>
  <style>
    /* CSS như bạn đã viết ở trên */
  </style>
</head>
<body>
<form method="post">
    <h2>Sửa đơn hàng</h2>
    Tên khách hàng:
    <input type="text" name="ten_khach_hang" value="<?= htmlspecialchars($order['ten_khach_hang']) ?>" required><br>

    ID Khách hàng:
    <select name="id_khachhang" required>
        <?php while($cus = $customers->fetch_assoc()): ?>
            <option value="<?= $cus['id'] ?>" <?= $order['id_khachhang'] == $cus['id'] ? 'selected' : '' ?>>
                <?= $cus['id'] ?> - <?= htmlspecialchars($cus['ten_khach_hang']) ?>
            </option>
        <?php endwhile; ?>
    </select><br>

    Ngày đặt: <input type="date" name="ngay_dat" value="<?= $order['ngay_dat'] ?>"><br>
    Giờ đặt: <input type="time" name="gio_dat" value="<?= $order['gio_dat'] ?>" required><br>
    Tổng tiền: <input type="number" name="tong_tien" value="<?= $order['tong_tien'] ?>" required><br>

    Trạng thái:
    <select name="trang_thai">
        <option <?= $order['trang_thai'] == 'Đang gửi' ? 'selected' : '' ?>>Đang gửi</option>
        <option <?= $order['trang_thai'] == 'Hoàn thành' ? 'selected' : '' ?>>Hoàn thành</option>
        <option <?= $order['trang_thai'] == 'Đã hủy' ? 'selected' : '' ?>>Đã hủy</option>
    </select><br><br>

    <button type="submit">Cập nhật</button>
</form>
</body>
</html>
