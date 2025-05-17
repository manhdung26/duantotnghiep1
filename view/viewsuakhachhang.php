<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Khách Hàng</title>
</head>
<body>

<h2>Sửa Khách Hàng</h2>

<form action="" method="post">
    <label for="ten_khach_hang">Tên khách hàng:</label>
    <input type="text" name="ten_khach_hang" value="<?php echo htmlspecialchars($customer['ten_khach_hang']); ?>" required>

    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($customer['email']); ?>" required>

    <label for="so_dien_thoai">Số điện thoại:</label>
    <input type="text" name="so_dien_thoai" value="<?php echo htmlspecialchars($customer['so_dien_thoai']); ?>">

    <label for="dia_chi">Địa chỉ:</label>
    <input type="text" name="dia_chi" value="<?php echo htmlspecialchars($customer['dia_chi']); ?>">

    <input type="submit" name="edit_customer" value="Cập nhật">
</form>


</body>
</html>
