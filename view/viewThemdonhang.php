<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Đơn Hàng</title>
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
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 20px;
    overflow-y: auto;
    max-height: 95vh;
}

h2, h3 {
    color: #4caf50;
    text-align: center;
    margin: 0;
}

.form-group {
    margin-bottom: 12px;
}

label {
    font-weight: 600;
    display: block;
    margin-bottom: 6px;
}

input[type="text"],
input[type="email"],
input[type="date"],
input[type="time"],
input[type="number"],
select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 14px;
    box-sizing: border-box;
    background-color: #fafafa;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 12px;
    width: 100%;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #388e3c;
}

input[type="submit"]:active {
    background-color: #2c6d2f;
}

.product-item {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    margin-bottom: 8px;
    font-size: 14px;
    padding: 5px;
}

.product-item img {
    width: 50px;
    height: 50px;
    margin-right: 10px;
    object-fit: cover; /* Đảm bảo hình ảnh không bị biến dạng */
}

.product-item .product-info {
    flex-grow: 1;
}

.product-item input[type="checkbox"] {
    margin-right: 10px;
}

.product-item input[type="number"] {
    width: 60px;
    margin-left: 8px;
    padding: 6px;
}

/* Căn chỉnh phần nội dung sản phẩm trong container */
#product-list {
    max-height: 200px;
    overflow-y: auto;
    padding-right: 5px;
}

/* Cập nhật tổng tiền */
#total-price {
    font-size: 18px;
    font-weight: bold;
    color: #388e3c;
    text-align: center;
    margin-top: 10px;
}


.back-link {
    text-align: center;
    margin-top: 20px;
    color: #007bff;
    text-decoration: none;
    font-weight: 500;
    font-size: 14px;
}

.back-link:hover {
    text-decoration: underline;
    color: #0056b3;
}
    </style>
</head>
<body>
<div class="form-container">
    <h2>Thêm Đơn Hàng</h2>
    <form method="POST" action="indexthemdonhang.php" onsubmit="return validateForm();">
    <!-- Thông tin khách hàng -->
    <div class="form-group">
        <label for="ten_khach_hang">Tên khách hàng:</label>
        <input type="text" id="ten_khach_hang" name="ten_khach_hang" required>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="so_dien_thoai">Số điện thoại:</label>
        <input type="text" id="so_dien_thoai" name="so_dien_thoai" required>
    </div>
    <div class="form-group">
        <label for="dia_chi">Địa chỉ:</label>
        <input type="text" id="dia_chi" name="dia_chi" required>
    </div>
    <div class="form-group">
        <label for="ngay_dat">Ngày đặt:</label>
        <input type="date" id="ngay_dat" name="ngay_dat" required>
    </div>
    <div class="form-group">
        <label for="gio_dat">Giờ đặt:</label>
        <input type="time" id="gio_dat" name="gio_dat" required>
    </div>

    <!-- Chọn sản phẩm -->
    <h3>Chọn sản phẩm</h3>
    <div id="product-list">
        <?php
        if ($result_sanpham->num_rows > 0) {
            while ($row = $result_sanpham->fetch_assoc()) {
                echo "<div class='product-item'>
                        <input type='checkbox' name='products[]' value='" . $row['id'] . "' data-price='" . $row['gia'] . "'> 
                        <img src='img/" . $row['anh'] . "' alt='" . $row['ten'] . "'>
                        " . $row['ten'] . " - " . number_format($row['gia'], 0, ',', '.') . "₫
                        <input type='number' name='quantity[" . $row['id'] . "]' min='1' value='1' class='quantity' data-price='" . $row['gia'] . "'>
                    </div>";
            }
        } else {
            echo "Không có sản phẩm.";
        }
        ?>
    </div>

    <h3>Tổng tiền: <span id="total-price">0₫</span></h3>
    <input type="hidden" id="tong_tien" name="tong_tien">

    <!-- Trạng thái -->
    <div class="form-group">
        <label for="trang_thai">Trạng thái:</label>
        <select name="trang_thai" id="trang_thai" required>
            <option value="Đang gửi">Đang gửi</option>
            <option value="Hoàn thành">Hoàn thành</option>
            <option value="Đã hủy">Đã hủy</option>
        </select>
    </div>

    <!-- Phương thức thanh toán -->
    <div class="form-group">
        <label for="phuong_thuc_thanh_toan">Phương thức thanh toán:</label>
        <select name="phuong_thuc_thanh_toan" id="phuong_thuc_thanh_toan" required>
            <option value="Tiền mặt">Tiền mặt</option>
            <option value="Thanh toán ngay">Thanh toán ngay</option>
        </select>
    </div>

    <!-- Nút submit -->
    <input type="submit" value="Thêm đơn hàng">
</form>
    
    <!-- Popup QR -->
<div id="qrModal" style="display:none; position:fixed; top:0; left:0; right:0; bottom:0; background-color:rgba(0,0,0,0.5); z-index:999; justify-content:center; align-items:center;">
    <div style="background:white; padding:20px; border-radius:12px; text-align:center; position:relative; max-width:400px; width:90%;">
        <h3>Quét mã để thanh toán</h3>
        <img src="img/QR.jpg" alt="QR thanh toán" style="max-width:100%; height:auto; margin: 15px 0;">
        <button onclick="closeQR()" style="background:#4caf50; color:white; border:none; padding:10px 20px; border-radius:8px; cursor:pointer;">kiểm tra thanh toán</button>
    </div>
</div>
    <a href="indexdonhang.php" class="back-link">← Quay lại danh sách đơn hàng</a>
</div>


<script>
    function validateForm() {
        const email = document.getElementById('email').value.trim();
        const phone = document.getElementById('so_dien_thoai').value.trim();
        const checked = document.querySelectorAll('input[type="checkbox"]:checked');

        if (!email.endsWith('@gmail.com')) {
            alert('Email phải kết thúc bằng @gmail.com');
            return false;
        }

        if (!/^0\d{9}$/.test(phone)) {
            alert('Số điện thoại phải bắt đầu bằng số 0 và có 10 chữ số');
            return false;
        }

        if (checked.length === 0) {
            alert('Vui lòng chọn ít nhất một sản phẩm.');
            return false;
        }

        return true;
    }

    function updateTotalPrice() {
        let totalPrice = 0;
        document.querySelectorAll('.product-item').forEach(item => {
            const checkbox = item.querySelector('input[type="checkbox"]');
            const quantityInput = item.querySelector('.quantity');
            if (checkbox.checked) {
                quantityInput.disabled = false;
                const quantity = parseInt(quantityInput.value) || 0;
                const price = parseFloat(quantityInput.dataset.price);
                totalPrice += quantity * price;
            } else {
                quantityInput.disabled = true;
            }
        });
        document.getElementById('total-price').textContent = totalPrice.toLocaleString() + "₫";
        document.getElementById('tong_tien').value = totalPrice;
    }

    function closeQR() {
        document.getElementById('qrModal').style.display = 'none';
        alert('🎉 Thanh toán thành công!');
    }

    document.getElementById('phuong_thuc_thanh_toan').addEventListener('change', function () {
        if (this.value === 'Thanh toán ngay') {
            document.getElementById('qrModal').style.display = 'flex';
        } else {
            closeQR();
        }
    });

    document.querySelectorAll('.quantity').forEach(input => {
        input.addEventListener('input', updateTotalPrice);
    });

    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', updateTotalPrice);
    });

    updateTotalPrice(); // Gọi ngay khi trang load
</script>

</body>
</html>