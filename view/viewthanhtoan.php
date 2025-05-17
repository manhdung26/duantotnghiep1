<?php
$tongtien = 0;
?>

<h2>Thanh toán</h2>

<?php if (!empty($_SESSION['cart'])): ?>
    <h3>Sản phẩm trong giỏ hàng</h3>
    <table border="1" cellpadding="10">
        <tr>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
        </tr>
      <?php foreach ($_SESSION['cart'] as $item): 
        $thanhtien = $item['price'] * $item['quantity'];
        $tongtien += $thanhtien;
    ?>
    <tr>
        <td><?= htmlspecialchars($item['name']) ?></td>
        <td><?= number_format($item['price']) ?> VNĐ</td>
        <td><?= $item['quantity'] ?></td>
        <td><?= number_format($thanhtien) ?> VNĐ</td>
    </tr>
    <?php endforeach; ?>
    </table>

    <p><strong>Tổng tiền: <?= number_format($tongtien) ?> VNĐ</strong></p>
    <h2>Thông tin khách hàng</h2>
    <form method="POST" action="indexxacnhan.php">
    <label for="ten_khach_hang">Tên khách hàng:</label>
    <input type="text" name="ten_khach_hang" value="<?= isset($hoten) ? htmlspecialchars($hoten) : '' ?>" required><br><br>

    <label for="email">Email:</label>
    <input type="email" name="email" required><br><br>

    <label for="so_dien_thoai">Số điện thoại:</label>
    <input type="text" name="so_dien_thoai" required><br><br>

    <label for="dia_chi">Địa chỉ:</label>
    <input type="text" name="dia_chi" required><br><br>

    <input type="hidden" name="tong_tien" value="<?php echo $tongtien; ?>">
    
    <button type="submit" name="xacnhan">Xác nhận thanh toán</button>
</form>
<?php else: ?>
    <p>Không có sản phẩm trong giỏ hàng.</p>
<?php endif; ?>
