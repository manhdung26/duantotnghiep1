<?php
// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "detaitotnghiep");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy danh sách khách hàng
$sql = "SELECT * FROM khachhang";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh Sách Khách Hàng</title>
</head>
<body>

    <h1>Danh Sách Khách Hàng</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Khách Hàng</th>
                <th>Email</th>
                <th>Số Điện Thoại</th>
                <th>Địa Chỉ</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['ten_khach_hang']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['so_dien_thoai']; ?></td>
                    <td><?php echo $row['dia_chi']; ?></td>
                    <td>
                        <a href="indexxoakhachhang.php?id=<?php echo $row['id']; ?>">Xóa</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>

<?php
$conn->close();
?>
