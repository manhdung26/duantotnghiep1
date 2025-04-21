<?php
// Kết nối CSDL
$conn = new mysqli("localhost", "root", "", "detaitotnghiep");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra xem form đã được gửi không
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_customer'])) {
    // Lấy dữ liệu từ form
    $ten_khach_hang = $_POST['ten_khach_hang'];
    $email = $_POST['email'];
    $so_dien_thoai = $_POST['so_dien_thoai'];
    $dia_chi = $_POST['dia_chi'];

    // Thêm khách hàng vào cơ sở dữ liệu
    $sql = "INSERT INTO khachhang (ten_khach_hang, email, so_dien_thoai, dia_chi) 
            VALUES ('$ten_khach_hang', '$email', '$so_dien_thoai', '$dia_chi')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Khách hàng đã được thêm thành công!";
        header("Location: khachhang.php");
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
  <title>Thêm Khách Hàng</title>
  <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('img/image.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
    }

    .form-container {
        background: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
        width: 400px;
        max-width: 100%;
        box-sizing: border-box;
    }

    h2 {
        text-align: center;
        color: #4caf50;
        margin-bottom: 20px;
        font-size: 24px;
    }

    label {
        display: block;
        margin-top: 12px;
        font-weight: 600;
        color: #333;
    }

    input[type="text"],
    input[type="email"],
    input[type="tel"] {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
        box-sizing: border-box;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="tel"]:focus {
        border-color: #4caf50;
        outline: none;
    }

    button[type="submit"] {
        margin-top: 20px;
        width: 100%;
        padding: 12px;
        background: #4caf50;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    button[type="submit"]:hover {
        background: #388e3c;
    }
  </style>
</head>
<body>

<div class="form-container">
    <h2>Thêm Khách Hàng</h2>
    <form method="POST">
        <label for="ten_khach_hang">Tên khách hàng:</label>
        <input type="text" id="ten_khach_hang" name="ten_khach_hang" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="so_dien_thoai">Số điện thoại:</label>
        <input type="text" id="so_dien_thoai" name="so_dien_thoai">

        <label for="dia_chi">Địa chỉ:</label>
        <input type="text" id="dia_chi" name="dia_chi">

        <button type="submit" name="add_customer">Thêm khách hàng</button>
    </form>
</div>

</body>
</html>
