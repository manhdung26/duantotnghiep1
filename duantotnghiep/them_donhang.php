<?php
// Kết nối CSDL
$conn = new mysqli("localhost", "root", "", "detaitotnghiep");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Truy vấn tất cả sản phẩm
$sql_sanpham = "SELECT id, ten, gia FROM sanpham";
$result_sanpham = $conn->query($sql_sanpham);

// Xử lý form khi người dùng gửi yêu cầu thêm đơn hàng
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten_khach_hang = $_POST['ten_khach_hang'];
    $email = $_POST['email'];
    $so_dien_thoai = $_POST['so_dien_thoai'];
    $dia_chi = $_POST['dia_chi'];
    $ngay_dat = $_POST['ngay_dat'];
    $gio_dat = $_POST['gio_dat'];
    $phuong_thuc_thanh_toan = $_POST['phuong_thuc_thanh_toan'];
    $trang_thai = $_POST['trang_thai'];

// Tự động cập nhật trạng thái nếu thanh toán ngay
if ($phuong_thuc_thanh_toan === 'Thanh toán ngay') {
    $trang_thai = 'Đã thanh toán';
}

    // Kiểm tra khách hàng đã tồn tại chưa
    $check_sql = "SELECT id FROM khachhang WHERE email = '$email' OR so_dien_thoai = '$so_dien_thoai'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        $row = $check_result->fetch_assoc();
        $id_khachhang = $row['id'];
    } else {
        $insert_customer_sql = "INSERT INTO khachhang (ten_khach_hang, email, so_dien_thoai, dia_chi) 
                                VALUES ('$ten_khach_hang', '$email', '$so_dien_thoai', '$dia_chi')";
        if ($conn->query($insert_customer_sql) === TRUE) {
            $id_khachhang = $conn->insert_id;
        } else {
            echo "Lỗi khi thêm khách hàng: " . $conn->error;
            exit;
        }
    }

    // Tính tổng tiền từ sản phẩm được chọn
    $tong_tien = 0;
    if (isset($_POST['products'])) {
        foreach ($_POST['products'] as $product_id) {
            $quantity = intval($_POST['quantity'][$product_id]);
            $sql = "SELECT gia FROM sanpham WHERE id = $product_id";
            $result = $conn->query($sql);
            if ($row = $result->fetch_assoc()) {
                $tong_tien += $row['gia'] * $quantity;
            }
        }
    }

    // Thêm đơn hàng vào CSDL
    $insert_order_sql = "INSERT INTO donhang (ten_khach_hang, id_khachhang, ngay_dat, gio_dat, tong_tien, trang_thai, phuong_thuc_thanh_toan) 
                     VALUES ('$ten_khach_hang', '$id_khachhang', '$ngay_dat', '$gio_dat', '$tong_tien', '$trang_thai', '$phuong_thuc_thanh_toan')";

    if ($conn->query($insert_order_sql) === TRUE) {
        $order_id = $conn->insert_id;

        // Thêm sản phẩm vào đơn hàng
        if (isset($_POST['products'])) {
            foreach ($_POST['products'] as $product_id) {
                if (isset($_POST['quantity'][$product_id])) {
                    $quantity = $_POST['quantity'][$product_id];
                    $insert_product_order_sql = "INSERT INTO donhang_sanpham (id_donhang, id_sanpham, so_luong) 
                                                 VALUES ('$order_id', '$product_id', '$quantity')";
                    $conn->query($insert_product_order_sql);
                }
            }
        }

        header("Location: donhang.php");
        exit();
    } else {
        echo "Lỗi khi thêm đơn hàng: " . $conn->error;
    }
}
?>

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
    justify-content: space-between;
    margin-bottom: 8px;
    font-size: 14px;
}

.product-item input[type="checkbox"] {
    margin-right: 8px;
}

.product-item input[type="number"] {
    width: 60px;
    margin-left: 8px;
    padding: 6px;
}

#product-list {
    max-height: 200px;
    overflow-y: auto;
    padding-right: 5px;
}

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
    <form method="POST" action="them_donhang.php">
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
        

        <!-- Phần chọn sản phẩm -->
        <h3>Chọn sản phẩm</h3>
        <div id="product-list">
            <?php
            if ($result_sanpham->num_rows > 0) {
                while ($row = $result_sanpham->fetch_assoc()) {
                    echo "<div class='product-item'>
                            <input type='checkbox' name='products[]' value='" . $row['id'] . "' data-price='" . $row['gia'] . "'> 
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

        <!-- Trường tổng tiền (ẩn để gửi về server) -->
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
       
        <!-- Phương thức thanh toán-->
        <div class="form-group">
    <label for="phuong_thuc_thanh_toan">Phương thức thanh toán:</label>
    <select name="phuong_thuc_thanh_toan" id="phuong_thuc_thanh_toan" required>
        <option value="Tiền mặt">Tiền mặt</option>
        <option value="Thanh toán ngay">Thanh toán ngay</option>
    </select>
</div>


        <!-- Submit cuối cùng -->
        <input type="submit" value="Thêm đơn hàng">
    </form>
    <!-- Popup QR -->
<div id="qrModal" style="display:none; position:fixed; top:0; left:0; right:0; bottom:0; background-color:rgba(0,0,0,0.5); z-index:999; justify-content:center; align-items:center;">
    <div style="background:white; padding:20px; border-radius:12px; text-align:center; position:relative; max-width:400px; width:90%;">
        <h3>Quét mã để thanh toán</h3>
        <img src="img/QR.jpg" alt="QR thanh toán" style="max-width:100%; height:auto; margin: 15px 0;">
        <button onclick="closeQR()" style="background:#4caf50; color:white; border:none; padding:10px 20px; border-radius:8px; cursor:pointer;">Đóng</button>
    </div>
</div>
    <a href="donhang.php" class="back-link">← Quay lại danh sách đơn hàng</a>
</div>

<script>
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

    function closeQR() {
    document.getElementById('qrModal').style.display = 'none';
    alert('🎉 Thanh toán thành công!');
}


    // Gọi khi trang load xong
    updateTotalPrice();
</script>

</body>
</html>

<?php
$conn->close();
?>
