<?php
$conn = new mysqli("localhost", "root", "", "detaitotnghiep");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Truy vấn để lấy thông tin đơn hàng bao gồm id_khachhang, ngày và giờ
    $sql = "SELECT * FROM donhang WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_khachhang = $_POST['id_khachhang'];  // Lấy ID khách hàng từ form
    $ten_khach = $_POST['ten_khach_hang'];
    $ngay_dat = $_POST['ngay_dat'];
    $gio_dat = $_POST['gio_dat'];  // Lấy giờ từ form (nếu có thay đổi)
    $tong_tien = $_POST['tong_tien'];
    $trang_thai = $_POST['trang_thai'];

    // Nếu người dùng không thay đổi ngày đặt, giữ nguyên ngày cũ
    if ($ngay_dat == "") {
        $ngay_dat = $row['ngay_dat'];  // Giữ giá trị ngày cũ
    }

    // Nếu người dùng không thay đổi giờ, giữ nguyên giờ cũ
    if ($gio_dat == "") {
        $gio_dat = $row['gio_dat'];  // Giữ giá trị giờ cũ
    }

    // Cập nhật thông tin đơn hàng
    $sql = "UPDATE donhang SET 
            id_khachhang = '$id_khachhang', 
            ten_khach_hang = '$ten_khach', 
            ngay_dat = '$ngay_dat', 
            gio_dat = '$gio_dat', 
            tong_tien = '$tong_tien', 
            trang_thai = '$trang_thai' 
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: donhang.php");
        exit();
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>
<head>
  <meta charset="UTF-8">
  <title>Sửa đơn hàng</title>
  <style>
    body {
        font-family: Arial, sans-serif;
        background-image: url('img/Screenshot\ 2025-04-27\ 092422.png'); /* ← Đường dẫn ảnh nền */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    form {
        background: rgba(255, 255, 255, 0.95); /* Nền mờ để nổi bật trên ảnh */
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        width: 400px;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    input, select {
        width: 100%;
        padding: 8px 10px;
        margin: 8px 0;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    button {
        width: 100%;
        padding: 10px;
        background: #007bff;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
    }

    button:hover {
        background: #0056b3;
    }
  </style>
</head>
<body>
  <form method="post">
    <h2>Sửa đơn hàng</h2>
    Tên khách hàng: <input type="text" name="ten_khach_hang" value="<?= isset($row['ten_khach_hang']) ? $row['ten_khach_hang'] : '' ?>" required><br>
    ID Khách hàng: <input type="number" name="id_khachhang" value="<?= isset($row['id_khachhang']) ? $row['id_khachhang'] : '' ?>" required><br>
    Ngày đặt: <input type="date" name="ngay_dat" value="<?= isset($row['ngay_dat']) ? $row['ngay_dat'] : '' ?>"><br>
    Giờ đặt: <input type="time" name="gio_dat" value="<?= isset($row['gio_dat']) ? $row['gio_dat'] : '' ?>" required><br>
    Tổng tiền: <input type="number" name="tong_tien" value="<?= isset($row['tong_tien']) ? $row['tong_tien'] : '' ?>" required><br>
    Trạng thái: 
    <select name="trang_thai">
        <option <?= isset($row['trang_thai']) && $row['trang_thai'] == 'Đang gửi' ? 'selected' : '' ?>>Đang gửi</option>
        <option <?= isset($row['trang_thai']) && $row['trang_thai'] == 'Hoàn thành' ? 'selected' : '' ?>>Hoàn thành</option>
        <option <?= isset($row['trang_thai']) && $row['trang_thai'] == 'Đã hủy' ? 'selected' : '' ?>>Đã hủy</option>
    </select><br><br>
    <button type="submit">Cập nhật</button>
  </form>
</body>

