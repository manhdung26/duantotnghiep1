<?php
// Kết nối CSDL
$conn = new mysqli("localhost", "root", "", "detaitotnghiep");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra và lấy ID sản phẩm cần sửa
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM sanpham WHERE id = $id";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
}

// Kiểm tra khi form được gửi đi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten = $_POST['ten'];
    $gia = $_POST['gia'];
    $mota = $_POST['mota'];
    $soluong = $_POST['soluong'];
    $luotban = $_POST['luotban'];
    $noi_bat = isset($_POST['noi_bat']) ? 1 : 0;

    if ($_FILES['anh']['name']) {
        $anh = $_FILES['anh']['name'];
        move_uploaded_file($_FILES['anh']['tmp_name'], 'img/' . $anh);
        $sql = "UPDATE sanpham SET ten = '$ten', gia = '$gia', anh = '$anh', mota = '$mota', so_luong = '$soluong', luot_ban = '$luotban', noi_bat = '$noi_bat' WHERE id = $id";
    } else {
        $sql = "UPDATE sanpham SET ten = '$ten', gia = '$gia', mota = '$mota', so_luong = '$soluong', luot_ban = '$luotban', noi_bat = '$noi_bat' WHERE id = $id";
    }

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
  <title>Sửa Sản Phẩm</title>
  <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-image: url('img/Screenshot\ 2025-04-27\ 092422.png');
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
        background: rgba(255, 255, 255, 0.95);
        padding: 35px 30px;
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
        width: 480px;
        box-sizing: border-box;
    }

    h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #333;
    }

    label {
        display: block;
        margin-top: 14px;
        font-weight: 600;
        color: #444;
    }

    input[type="text"],
    input[type="number"],
    input[type="file"],
    textarea {
        width: 100%;
        padding: 10px 12px;
        margin-top: 6px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 15px;
        box-sizing: border-box;
    }

    textarea {
        height: 100px;
        resize: vertical;
    }

    input[type="checkbox"] {
        margin-top: 10px;
        transform: scale(1.2);
        margin-right: 8px;
    }

    .checkbox-label {
        display: flex;
        align-items: center;
        margin-top: 16px;
        font-weight: 600;
        color: #333;
    }

    input[type="submit"] {
        margin-top: 24px;
        width: 100%;
        padding: 12px;
        background: #28a745;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 17px;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    input[type="submit"]:hover {
        background: #218838;
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
  <h2>Sửa sản phẩm</h2>
  <form action="sua_sanpham.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
      <label for="ten">Tên sản phẩm:</label>
      <input type="text" id="ten" name="ten" value="<?php echo $product['ten']; ?>" required>

      <label for="gia">Giá:</label>
      <input type="number" id="gia" name="gia" value="<?php echo $product['gia']; ?>" required>

      <label for="soluong">Số lượng:</label>
      <input type="number" id="soluong" name="soluong" value="<?php echo $product['so_luong']; ?>" required>

      <label for="anh">Ảnh sản phẩm (không bắt buộc):</label>
      <input type="file" id="anh" name="anh">

      <label for="mota">Mô tả:</label>
      <textarea id="mota" name="mota" required><?php echo $product['mota']; ?></textarea>

      <label for="luotban">Lượt bán:</label>
      <input type="number" id="luotban" name="luotban" value="<?php echo $product['luot_ban']; ?>" required>

      <label class="checkbox-label">
        <input type="checkbox" name="noi_bat" value="1" <?php echo ($product['noi_bat'] == 1) ? 'checked' : ''; ?>>
        Đánh dấu là sản phẩm nổi bật
      </label>

      <input type="submit" value="Cập nhật sản phẩm">
  </form>
  <a href="sanpham.php" class="back-link">← Quay lại danh sách sản phẩm</a>
</div>

</body>
</html>
