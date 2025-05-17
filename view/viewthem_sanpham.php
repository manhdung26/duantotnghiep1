<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Thêm Sản Phẩm</title>
  <style>
    body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-image: url('img/Screenshot 2025-04-27 092422.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin: 0;
    padding: 20px;
}

.form-container {
    background: rgba(255, 255, 255, 0.95);
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    width: 100%;
    max-width: 500px;
    box-sizing: border-box;
    backdrop-filter: blur(6px);
}

h2 {
    text-align: center;
    color: #2e7d32;
    margin-bottom: 25px;
    font-size: 26px;
}

label {
    display: block;
    margin-top: 15px;
    font-weight: 600;
    color: #444;
    font-size: 14px;
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
    font-size: 14px;
    box-sizing: border-box;
    transition: border 0.3s;
}

input[type="text"]:focus,
input[type="number"]:focus,
input[type="file"]:focus,
textarea:focus {
    border-color: #4caf50;
    outline: none;
}

textarea {
    resize: vertical;
    min-height: 100px;
}

input[type="submit"] {
    margin-top: 25px;
    width: 100%;
    padding: 14px;
    background: #4caf50;
    color: white;
    border: none;
    border-radius: 8px;
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
    <form action="indexthemsanpham.php" method="post" enctype="multipart/form-data">
        <label for="ten">Tên sản phẩm:</label>
        <input type="text" id="ten" name="ten" required>

        <label for="gia">Giá:</label>
        <input type="number" id="gia" name="gia" required>

        <label for="soluong">Số lượng:</label>
        <input type="number" id="soluong" name="soluong" required>

        <label for="anh">Ảnh sản phẩm:</label>
        <input type="file" id="anh" name="anh" required>

        <label for="anh2">Ảnh sản phẩm 2:</label>
        <input type="file" id="anh2" name="anh2" accept="image/*">

        <label for="anh3">Ảnh sản phẩm 3:</label>
        <input type="file" id="anh3" name="anh3" accept="image/*">

        <label for="anh4">Ảnh sản phẩm 4:</label>
        <input type="file" id="anh4" name="anh4" accept="image/*">

        <label for="mota">Mô tả:</label>
        <textarea id="mota" name="mota" required></textarea>

        <label for="chatlieu">Chất liệu:</label>
        <input type="text" id="chatlieu" name="chatlieu">

        <label for="kichthuoc">Kích thước:</label>
        <input type="text" id="kichthuoc" name="kichthuoc">

        <label for="mausac">Màu sắc:</label>
        <input type="text" id="mausac" name="mausac">

        <label for="baohanh">Bảo hành:</label>
        <input type="text" id="baohanh" name="baohanh">

        <label for="thuonghieu">Thương hiệu:</label>
        <input type="text" id="thuonghieu" name="thuonghieu">

        <select id="id_]danhmuc" name="danhmuc_id" required>
        <option value="">-- Chọn danh mục --</option>
        <?php foreach ($danhmucs as $dm) : ?>
        <option value="<?= $dm['id'] ?>"><?= htmlspecialchars($dm['ten_danhmuc']) ?></option>
        <?php endforeach; ?>
        </select>

        <input type="submit" value="Thêm sản phẩm">
    </form>
</div>

</body>
</html>