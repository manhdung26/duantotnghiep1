<?php
class modelsThemdonhang {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Thêm khách hàng mới
    public function addCustomer($ten_khach_hang, $email, $so_dien_thoai, $dia_chi) {
        $stmt = $this->conn->prepare("INSERT INTO khachhang (ten_khach_hang, email, so_dien_thoai, dia_chi) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $ten_khach_hang, $email, $so_dien_thoai, $dia_chi);

        if ($stmt->execute()) {
            return $this->conn->insert_id;
        } else {
            return false;
        }
    }

    // Kiểm tra khách hàng đã tồn tại hay chưa
    public function checkCustomerExist($email, $so_dien_thoai) {
        $stmt = $this->conn->prepare("SELECT * FROM khachhang WHERE email = ? OR so_dien_thoai = ?");
        $stmt->bind_param("ss", $email, $so_dien_thoai);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Trả về dữ liệu khách hàng nếu có
    }

    // Lấy danh sách sản phẩm
    public function getProducts() {
        $sql_sanpham = "SELECT id, ten, gia, anh FROM sanpham";
        return $this->conn->query($sql_sanpham);
    }

    // Tạo đơn hàng
    public function createOrder($id_khachhang, $ten_khach_hang, $ngay_dat, $gio_dat, $tong_tien, $trang_thai, $phuong_thuc_thanh_toan) {
        $stmt = $this->conn->prepare("INSERT INTO donhang (ten_khach_hang, id_khachhang, ngay_dat, gio_dat, tong_tien, trang_thai, phuong_thuc_thanh_toan) 
                                      VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssdss", $ten_khach_hang, $id_khachhang, $ngay_dat, $gio_dat, $tong_tien, $trang_thai, $phuong_thuc_thanh_toan);
        
        if ($stmt->execute()) {
            return $this->conn->insert_id;
        }
        return false;
    }

    // Thêm sản phẩm vào đơn hàng
    public function addProductToOrder($order_id, $product_id, $quantity) {
        $stmt = $this->conn->prepare("INSERT INTO donhang_sanpham (id_donhang, id_sanpham, so_luong) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $order_id, $product_id, $quantity);
        return $stmt->execute();
    }

    // Cập nhật số lượng tồn kho của sản phẩm
    public function updateProductStock($product_id, $quantity) {
        $stmt = $this->conn->prepare("UPDATE sanpham SET so_luong = so_luong - ? WHERE id = ?");
        $stmt->bind_param("ii", $quantity, $product_id);
        return $stmt->execute();
    }
    
    // Lấy thông tin giá của sản phẩm
    public function getProductById($product_id) {
        $stmt = $this->conn->prepare("SELECT gia FROM sanpham WHERE id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Trả về dữ liệu sản phẩm nếu có
    }
}

?>
