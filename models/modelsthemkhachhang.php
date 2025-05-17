<?php
class modelsThemkhachhang {
    private $conn;

    // Nhận kết nối từ controller
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Thêm khách hàng vào cơ sở dữ liệu
    public function addCustomer($ten_khach_hang, $email, $so_dien_thoai, $dia_chi) {
        // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu chưa
        $sql_check = "SELECT * FROM khachhang WHERE email = ?";
        $stmt_check = $this->conn->prepare($sql_check);
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $result = $stmt_check->get_result();
        
        if ($result->num_rows > 0) {
            // Nếu email đã tồn tại, trả về false hoặc thông báo lỗi
            return false;
        }
    
        // Thêm khách hàng vào cơ sở dữ liệu
        $sql = "INSERT INTO khachhang (ten_khach_hang, email, so_dien_thoai, dia_chi) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $ten_khach_hang, $email, $so_dien_thoai, $dia_chi);
    
        return $stmt->execute();
    }
}
?>
