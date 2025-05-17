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
  <form action="indexsua_sanpham.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
      <label for="ten">Tên sản phẩm:</label>
      <input type="text" id="ten" name="ten" value="<?php echo $product['ten']; ?>" required>

      <label for="gia">Giá:</label>
      <input type="number" id="gia" name="gia" value="<?php echo $product['gia']; ?>" required>

      <label for="soluong">Số lượng:</label>
      <input type="number" name="so_luong" value="<?php echo $product['so_luong']; ?>" required>

      <label for="anh">Ảnh sản phẩm (không bắt buộc):</label>
      <input type="file" id="anh" name="anh">

      <!-- Thêm các trường ảnh phụ -->
      <label for="anh2">Ảnh phụ 2 (không bắt buộc):</label>
      <input type="file" id="anh2" name="anh2">
      
      <label for="anh3">Ảnh phụ 3 (không bắt buộc):</label>
      <input type="file" id="anh3" name="anh3">

      <label for="anh4">Ảnh phụ 4 (không bắt buộc):</label>
      <input type="file" id="anh4" name="anh4">

      <label for="mota">Mô tả:</label>
      <textarea id="mota" name="mota" required><?php echo $product['mota']; ?></textarea>

      <label for="luotban">Lượt bán:</label>
      <input type="number" name="luot_ban" value="<?php echo $product['luot_ban']; ?>" required>

      <label class="checkbox-label">
        <input type="checkbox" name="noi_bat" value="1" <?php echo ($product['noi_bat'] == 1) ? 'checked' : ''; ?>>
        Đánh dấu là sản phẩm nổi bật
      </label>

      <input type="submit" value="Cập nhật sản phẩm">
  </form>
  <a href="indexSP.php" class="back-link">← Quay lại danh sách sản phẩm</a>
</div>

</body>
</html>