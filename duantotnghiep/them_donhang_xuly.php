<?php
// Kết nối CSDL
$conn = new mysqli("localhost", "root", "", "detaitotnghiep");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy dữ liệu từ form
$ten_khach_hang = $_POST['ten_khach_hang'];
$id_khachhang = $_POST['id_khachhang'];
$products = $_POST['products']; // Sản phẩm đã chọn
$quantities = $_POST['quantity']; // Số lượng của từng sản phẩm

// Tính tổng tiền
$total_price = 0;
foreach ($products as $product_id) {
    $total_price += $quantities[$product_id] * getProductPrice($product_id, $conn);
}

// Thêm đơn hàng vào bảng donhang
$sql_donhang = "INSERT INTO donhang (ten_khach_hang, id_khachhang, tong_tien, trang_thai, ngay_dat, gio_dat) 
                VALUES ('$ten_khach_hang', '$id_khachhang', $total_price, 'Đang xử lý', NOW(), NOW())";
if ($conn->query($sql_donhang) === TRUE) {
    $donhang_id = $conn->insert_id;

    // Thêm chi tiết đơn hàng vào bảng chitiet_donhang
    foreach ($products as $product_id) {
        $quantity = $quantities[$product_id];
        $price = getProductPrice($product_id, $conn);
        $sql_chitiet = "INSERT INTO chitiet_donhang (id_donhang, id_sanpham, so_luong, gia) 
                        VALUES ($donhang_id, $product_id, $quantity, $price)";
        $conn->query($sql_chitiet);
    }

    // Redirect đến trang đơn hàng
    header("Location: donhang.php");
} else {
    echo "Lỗi: " . $conn->error;
}

// Hàm lấy giá sản phẩm
function getProductPrice($product_id, $conn) {
    $sql = "SELECT gia FROM sanpham WHERE id = $product_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['gia'];
}

$conn->close();
?>
