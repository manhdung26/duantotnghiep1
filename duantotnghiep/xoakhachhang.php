<?php
// Kết nối CSDL
$conn = new mysqli("localhost", "root", "", "detaitotnghiep");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra nếu có yêu cầu xóa khách hàng
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Xóa khách hàng từ cơ sở dữ liệu
    $sql = "DELETE FROM khachhang WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        // Xóa thành công, chuyển hướng về trang khách hàng
        header("Location: khachhang.php");
        exit(); // Dừng script sau khi chuyển hướng
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

$conn->close();
?>
