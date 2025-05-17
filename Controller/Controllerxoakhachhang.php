<?php
require_once 'models/modelsxoakhachhang.php';

class KhachHangController {
    private $model;

    // Khởi tạo với kết nối cơ sở dữ liệu
    public function __construct($conn) {
        $this->model = new modelsXoakhachhang($conn);
    }

    // Xử lý xóa khách hàng
    public function deleteCustomer() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Gọi phương thức xóa khách hàng từ model
            $result = $this->model->deleteCustomer($id);

            if ($result) {
                // Chuyển hướng về trang khách hàng sau khi xóa thành công
                header("Location: indexKH.php");
                exit();
            } else {
                echo "Lỗi khi xóa khách hàng.";
            }
        }
    }
}
?>
