<?php
require_once 'models/modelsthemdonhang.php';

class ControllerThemdonhang {
    private $orderModel;

    public function __construct($db) {
        $this->orderModel = new modelsThemdonhang($db);
    }

    public function addOrder() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $ten_khach_hang = $_POST['ten_khach_hang'];
            $email = $_POST['email'];
            $so_dien_thoai = $_POST['so_dien_thoai'];
            $dia_chi = $_POST['dia_chi'];
            $ngay_dat = $_POST['ngay_dat'];
            $gio_dat = $_POST['gio_dat'];
            $phuong_thuc_thanh_toan = $_POST['phuong_thuc_thanh_toan'];
            $trang_thai = $_POST['trang_thai'];

            // Kiểm tra email và số điện thoại
            if (strpos($email, '@gmail.com') === false) {
                echo "<script>alert('Email phải có đuôi @gmail.com'); window.history.back();</script>";
                exit();
            }
            if (!preg_match('/^0[0-9]{9}$/', $so_dien_thoai)) {
                echo "<script>alert('Số điện thoại phải bắt đầu bằng số 0 và đủ 10 số'); window.history.back();</script>";
                exit();
            }

            // Kiểm tra khách hàng đã tồn tại chưa
            $customer = $this->orderModel->checkCustomerExist($email, $so_dien_thoai);
            if ($customer) {
                $id_khachhang = $customer['id'];
            } else {
                $id_khachhang = $this->orderModel->addCustomer($ten_khach_hang, $email, $so_dien_thoai, $dia_chi);
            }

            // Tính tổng tiền
            $tong_tien = 0;
            if (isset($_POST['products'])) {
                foreach ($_POST['products'] as $product_id) {
                    $quantity = intval($_POST['quantity'][$product_id]);
                    $row = $this->orderModel->getProductById($product_id);
                    if ($row) {
                        $tong_tien += $row['gia'] * $quantity;
                    }
                }
            }

            // Thêm đơn hàng vào CSDL
            $order_id = $this->orderModel->createOrder($id_khachhang, $ten_khach_hang, $ngay_dat, $gio_dat, $tong_tien, $trang_thai, $phuong_thuc_thanh_toan);

            // Thêm sản phẩm vào đơn hàng
            if ($order_id) {
                if (isset($_POST['products'])) {
                    foreach ($_POST['products'] as $product_id) {
                        if (isset($_POST['quantity'][$product_id])) {
                            $quantity = intval($_POST['quantity'][$product_id]);
                            $this->orderModel->addProductToOrder($order_id, $product_id, $quantity);
                            $this->orderModel->updateProductStock($product_id, $quantity);
                        }
                    }
                }
                header("Location: indexdonhang.php");
                exit();
            } else {
                echo "Lỗi khi thêm đơn hàng.";
            }
        }
    }

    public function showAddOrderForm() {
        $result_sanpham = $this->orderModel->getProducts();
        include('view/viewThemdonhang.php');
    }
}
