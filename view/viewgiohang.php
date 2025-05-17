<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Giỏ Hàng</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
        }
        .container {
            width: 800px;
            margin: 40px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        img {
            max-width: 80px;
        }
        .total {
            text-align: right;
            font-weight: bold;
            margin-top: 10px;
        }
        .btn {
            padding: 8px 16px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn:hover {
            background: #0056b3;
        }
        .btn-danger {
            background: #dc3545;
        }
        a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.3s;
        }
        a:hover {
            background-color: #218838;
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<a href="indexbanhang.php">quay lại mua hàng</a>

<div class="container">
    <h2>Giỏ Hàng</h2>

    <?php if (empty($cart)): ?>
        <p>Giỏ hàng của bạn hiện tại không có sản phẩm nào.</p>
    <?php else: ?>
        <form method="POST" action="indexgiohang.php">
            <table>
                <thead>
                    <tr>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $id => $item): ?>
                        <tr>
                            <td><img src="img/<?php echo htmlspecialchars($item['image']); ?>" alt="Ảnh sản phẩm"></td>
                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                            <td><?php echo number_format($item['price'], 0, ',', '.'); ?>₫</td>
                            <td>
                                <input type="number" name="quantity[<?php echo $id; ?>]" value="<?php echo $item['quantity']; ?>" min="1" style="width: 60px;">
                            </td>
                            <td><?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?>₫</td>
                            <td>
                                <a class="btn btn-danger" href="indexgiohang.php?remove=<?php echo $id; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="total">
                Tổng tiền: <?php echo number_format($total, 0, ',', '.'); ?>₫
            </div>

            <div style="margin-top: 10px;">
                <a href="indexthanhtoan.php" class="btn">Tiến hành thanh toán</a>
            </div>
        </form>
    <?php endif; ?>
</div>
</body>
</html>
