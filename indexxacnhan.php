<?php
session_start();
require_once('config/config.php');
$conn = Config::connect();

if (isset($_POST['xacnhan'])) {
    $ten_khach_hang = $_POST['ten_khach_hang'];
    $email = $_POST['email'];
    $so_dien_thoai = $_POST['so_dien_thoai'];
    $dia_chi = $_POST['dia_chi'];
    $tong_tien = $_POST['tong_tien'];

    // 1. Kiểm tra khách hàng đã tồn tại chưa
    $check_sql = "SELECT id FROM khachhang WHERE email = ? OR so_dien_thoai = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("ss", $email, $so_dien_thoai);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Khách hàng đã tồn tại, lấy ID
        $row = $result->fetch_assoc();
        $id_khachhang = $row['id'];
    } else {
        // 2. Thêm khách hàng mới
        $insert_kh = "INSERT INTO khachhang (ten_khach_hang, email, so_dien_thoai, dia_chi, ngay_dang_ky) VALUES (?, ?, ?, ?, NOW())";
        $stmt_insert = $conn->prepare($insert_kh);
        $stmt_insert->bind_param("ssss", $ten_khach_hang, $email, $so_dien_thoai, $dia_chi);
        $stmt_insert->execute();
        $id_khachhang = $stmt_insert->insert_id;
    }

    // 3. Tạo đơn hàng mới
    $ngay_dat = date('Y-m-d');
    $gio_dat = date('H:i:s');
    $trang_thai = 'Đã thanh toán';
    $pttt = 'Tiền mặt'; // Hoặc lấy từ form

    $insert_dh = "INSERT INTO donhang (ten_khach_hang, id_khachhang, ngay_dat, gio_dat, tong_tien, trang_thai, phuong_thuc_thanh_toan)
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt_dh = $conn->prepare($insert_dh);
    $stmt_dh->bind_param("sissdss", $ten_khach_hang, $id_khachhang, $ngay_dat, $gio_dat, $tong_tien, $trang_thai, $pttt);
    $stmt_dh->execute();

      // Lấy id đơn hàng mới
    $id_donhang = $stmt_dh->insert_id;

    // Giả sử $giohang là mảng sản phẩm có id, gia, soluong
    if (!empty($giohang)) {
        $stmt_ct = $conn->prepare("INSERT INTO chi_tiet_don_hang (donhang_id, sanpham_id, gia, so_luong) VALUES (?, ?, ?, ?)");

        foreach ($giohang as $sp) {
            $stmt_ct->bind_param("iidi", $id_donhang, $sp['id'], $sp['gia'], $sp['soluong']);
            $stmt_ct->execute();
        }
    }

    // 4. Chuyển hướng về trang đơn hàng và khách hàng
    header("Location: indexbanhang.php");
    exit;
}
?>
