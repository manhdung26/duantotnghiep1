<?php
// Kết nối CSDL
$conn = new mysqli("localhost", "root", "", "detaitotnghiep");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý khi form được gửi đi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten = $_POST['ten'];
    $gia = $_POST['gia'];
    $soluong = $_POST['soluong'];
    $mota = $_POST['mota'];
    $anh = $_FILES['anh']['name'];

    // Di chuyển ảnh vào thư mục "img"
    if ($anh) {
        move_uploaded_file($_FILES['anh']['tmp_name'], 'img/' . $anh);
    }

    // Thêm sản phẩm vào CSDL
    $sql = "INSERT INTO sanpham (ten, gia, so_luong, anh, mota) 
            VALUES ('$ten', '$gia', '$soluong', '$anh', '$mota')";

    if ($conn->query($sql) === TRUE) {
        header("Location: sanpham.php");
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
  <title>Thêm Sản Phẩm</title>
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
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
        width: 400px;
        box-sizing: border-box;
        max-width: 100%;
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
    input[type="number"],
    input[type="file"],
    textarea {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
        box-sizing: border-box;
    }

    textarea {
        resize: vertical;
        min-height: 80px;
    }

    input[type="submit"] {
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

    input[type="submit"]:hover {
        background: #388e3c;
    }
  </style>
</head>
<body>

<div class="form-container">
    <h2>Thêm sản phẩm mới</h2>
    <form action="them_sanpham.php" method="post" enctype="multipart/form-data">
        <label for="ten">Tên sản phẩm:</label>
        <input type="text" id="ten" name="ten" required>

        <label for="gia">Giá:</label>
        <input type="number" id="gia" name="gia" required>

        <label for="soluong">Số lượng:</label>
        <input type="number" id="soluong" name="soluong" required>

        <label for="anh">Ảnh sản phẩm:</label>
        <input type="file" id="anh" name="anh" required>

        <label for="mota">Mô tả:</label>
        <textarea id="mota" name="mota" required></textarea>

        <input type="submit" value="Thêm sản phẩm">
    </form>
</div>

</body>
</html>
