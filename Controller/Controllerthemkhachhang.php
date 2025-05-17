<?php
require_once 'models/modelsthemkhachhang.php';

class KhachHangController {
    private $model;

    public function __construct($conn) {
        $this->model = new modelsThemkhachhang($conn);  // Khởi tạo lớp KhachHangModel
    }

    public function addCustomer() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_customer'])) {
            // Lấy dữ liệu từ form
            $ten_khach_hang = $_POST['ten_khach_hang'];
            $email = $_POST['email'];
            $so_dien_thoai = $_POST['so_dien_thoai'];
            $dia_chi = $_POST['dia_chi'];
    
            // Thêm khách hàng vào cơ sở dữ liệu
            $result = $this->model->addCustomer($ten_khach_hang, $email, $so_dien_thoai, $dia_chi);
    
            if ($result) {
                // Chuyển hướng đến trang danh sách khách hàng sau khi thêm thành công
                header("Location: indexKH.php");
                exit();
            } else {
                // Nếu email đã tồn tại
                echo "Email đã được sử dụng. Vui lòng nhập email khác.";
            }
    } else {
            // Nếu không phải là POST, hiển thị form thêm khách hàng
            require_once 'view/viewthemkhachhang.php';
        }
    }
    
}
?>
