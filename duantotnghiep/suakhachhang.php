<?php
// Kết nối CSDL
$conn = new mysqli("localhost", "root", "", "detaitotnghiep");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy ID khách hàng từ URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM khachhang WHERE id = $id";
    $result = $conn->query($sql);
    $customer = $result->fetch_assoc();
}

// Kiểm tra nếu form sửa khách hàng được gửi
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_customer'])) {
    $ten_khach_hang = $_POST['ten_khach_hang'];
    $email = $_POST['email'];
    $so_dien_thoai = $_POST['so_dien_thoai'];
    $dia_chi = $_POST['dia_chi'];

    $sql = "UPDATE khachhang SET 
            ten_khach_hang = '$ten_khach_hang', 
            email = '$email', 
            so_dien_thoai = '$so_dien_thoai', 
            dia_chi = '$dia_chi' 
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: khachhang.php");
        exit();
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
    <title>Sửa Khách Hàng</title>
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
            background: #fff;
            padding: 35px 30px;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            width: 480px;
            box-sizing: border-box;
        }

        h2 {
            text-align: center;
            color: #2e7d32;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 14px;
            font-weight: 600;
            color: #444;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px 12px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
            box-sizing: border-box;
        }

        button {
            margin-top: 24px;
            width: 100%;
            padding: 12px;
            background: #2e7d32;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 17px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #1b5e20;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 18px;
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
        }

        .back-link:hover {
            text-decoration: underline;
            color: #0056b3;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Sửa Khách Hàng</h2>
    <form method="POST">
        <label for="ten_khach_hang">Tên khách hàng:</label>
        <input type="text" id="ten_khach_hang" name="ten_khach_hang" value="<?= $customer['ten_khach_hang'] ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= $customer['email'] ?>" required>

        <label for="so_dien_thoai">Số điện thoại:</label>
        <input type="text" id="so_dien_thoai" name="so_dien_thoai" value="<?= $customer['so_dien_thoai'] ?>">

        <label for="dia_chi">Địa chỉ:</label>
        <input type="text" id="dia_chi" name="dia_chi" value="<?= $customer['dia_chi'] ?>">

        <button type="submit" name="edit_customer">Cập nhật khách hàng</button>
    </form>
    <a href="khachhang.php" class="back-link">← Quay lại danh sách khách hàng</a>
</div>

</body>
</html>
