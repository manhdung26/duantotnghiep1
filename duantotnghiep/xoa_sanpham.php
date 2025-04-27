<?php
// Kết nối CSDL
$conn = new mysqli("localhost", "root", "", "detaitotnghiep");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra và lấy ID sản phẩm cần xóa
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM sanpham WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Sản phẩm đã được xóa thành công!";
        header("Location: sanpham.php");
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Xóa Sản Phẩm</title>
</head>
<body>

<h2>Xóa sản phẩm</h2>
<p>Bạn chắc chắn muốn xóa sản phẩm này không?</p>
<a href="xoa_sanpham.php?id=<?php echo $_GET['id']; ?>">Xóa</a> | <a href="sanpham.php">Hủy bỏ</a>

</body>
</html>
