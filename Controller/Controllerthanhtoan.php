<?php
require_once './models/modelsthanhtoan.php';
require_once './config/config.php';

class ControllerThanhtoan {
    private $model;

    public function __construct() {
      $this->model = new modelThanhtoan();
    }

 public function thanhToan()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['xacnhan'])) {
        $hoten = $_POST['ten_khach_hang'];
        $email = $_POST['email'];
        $sdt = $_POST['so_dien_thoai'];
        $diachi = $_POST['dia_chi'];
        $ngay = date("Y-m-d");
        $tongtien = $_POST['tong_tien'];

        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            echo "Giỏ hàng trống!";
            return;
        }

        $conn = (new Config())->connect();

        // Kiểm tra khách hàng đã có chưa
        $stmt = $conn->prepare("SELECT id FROM khachhang WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $khachhang_id = null;

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $khachhang_id = $row['id'];
        } else {
            // Nếu chưa có -> thêm mới
            $stmt_insert = $conn->prepare("INSERT INTO khachhang (ten_khach_hang, email, so_dien_thoai, dia_chi, ngay_dang_ky) VALUES (?, ?, ?, ?, ?)");
            $ngaydk = date("Y-m-d");
            $stmt_insert->bind_param("sssss", $hoten, $email, $sdt, $diachi, $ngaydk);
            $stmt_insert->execute();
            $khachhang_id = $conn->insert_id;
        }

        // Tạo mảng giỏ hàng để truyền cho model
        $giohang = [];
        foreach ($_SESSION['cart'] as $id => $item) {
            $giohang[] = [
                'id' => $id,
                'ten' => $item['name'],
                'gia' => $item['price'],
                'soluong' => $item['quantity']
            ];
        }

        // Lưu đơn hàng
        $sanpham_json = json_encode($giohang, JSON_UNESCAPED_UNICODE);
        $stmt_order = $conn->prepare("INSERT INTO donhang (id_khachhang, ten_khach_hang, so_dien_thoai, dia_chi, ngay_dat, tong_tien, san_pham) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt_order->bind_param("issssds", $khachhang_id, $hoten, $sdt, $diachi, $ngay, $tongtien, $sanpham_json);
        $stmt_order->execute();
        $id_donhang = $conn->insert_id;

        // Thêm chi tiết đơn hàng và trừ số lượng sản phẩm
        $this->model->updateSoLuongSanPham($giohang);

        // Xóa giỏ hàng
        unset($_SESSION['cart']);

        // Chuyển hướng về danh sách đơn hàng
        header("Location: indexbanhang.php");
        exit;
    }
}
}