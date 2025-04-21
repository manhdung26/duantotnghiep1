<?php
$conn = new mysqli("localhost", "root", "", "detaitotnghiep");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sanpham_id = $_POST['sanpham_id'];

    // Đánh dấu sản phẩm này là nổi bật (noi_bat = 1)
    $sql_update = "UPDATE sanpham SET noi_bat = 1 WHERE id = $sanpham_id";
    if ($conn->query($sql_update) === TRUE) {
        echo "Sản phẩm đã được đánh dấu là nổi bật!";   
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Sản phẩm Nổi Bật</title>
</head>
<body>
    <h2>Chọn Sản phẩm Nổi Bật</h2>
    <?php
// Lấy sản phẩm đang nổi bật
$sql_featured = "SELECT * FROM sanpham WHERE noi_bat = 1 LIMIT 1";
$result_featured = $conn->query($sql_featured);
if ($result_featured->num_rows > 0) {
    $featured = $result_featured->fetch_assoc();
    echo "<p><strong>Sản phẩm nổi bật hiện tại:</strong> " . $featured['ten'] . "</p>";
} else {
    echo "<p><strong>Chưa có sản phẩm nổi bật.</strong></p>";
}
?>
    <form action="quanly_sanpham.php" method="POST">
        <label for="sanpham_id">Chọn sản phẩm:</label>
        <select name="sanpham_id" id="sanpham_id">
            <?php
            // Lấy tất cả sản phẩm
            $sql_all_products = "SELECT * FROM sanpham";
            $result_all_products = $conn->query($sql_all_products);

            while ($row = $result_all_products->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['ten'] . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="Đánh dấu là Nổi Bật">
    </form>
</body>
</html>
