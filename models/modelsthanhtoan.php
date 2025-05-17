    <?php
    require_once './config/config.php';

    class modelThanhToan extends Config
    {
        public function createDonHang($hoten, $sdt, $diachi, $ngay, $tongtien, $giohang)
        {
            $conn = $this->connect();

            // Chuyển giỏ hàng thành JSON để lưu vào cột san_pham
            $sanpham_json = json_encode($giohang, JSON_UNESCAPED_UNICODE);

            // Thêm vào bảng đơn hàng
            $trangthai = "Đang gửi";
            $stmt_order = $conn->prepare("INSERT INTO donhang (id_khachhang, ten_khach_hang, so_dien_thoai, dia_chi, ngay_dat, tong_tien, san_pham, trang_thai) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt_order->bind_param("issssdss", $khachhang_id, $hoten, $sdt, $diachi, $ngay, $tongtien, $sanpham_json, $trangthai);
            $stmt_order->execute();
            $id_donhang = $conn->insert_id;
            return $id_donhang;
        }
    public function createChiTietDonHang($id_donhang, $giohang) {
    $conn = $this->connect();
    // Chuẩn bị câu lệnh
    $stmt_ct = $conn->prepare("INSERT INTO chitiet_donhang (donhang_id, sanpham_id, so_luong, gia) VALUES (?, ?, ?, ?)");
    if (!$stmt_ct) {
        throw new Exception("Prepare failed: " . $conn->error);
    }

    // Duyệt từng sản phẩm trong giỏ hàng
    foreach ($giohang as $sp) {
        // Kiểm tra dữ liệu trước khi bind (optional, tùy bạn)
        $id_sanpham = (int)$sp['id'];
        $soluong = (int)$sp['soluong'];
        $gia = (float)$sp['gia'];

        $stmt_ct->bind_param("iiid", $id_donhang, $id_sanpham, $soluong, $gia);

        if (!$stmt_ct->execute()) {
            // Nếu lỗi khi insert 1 chi tiết đơn hàng, bạn có thể xử lý hoặc throw
            throw new Exception("Execute failed: " . $stmt_ct->error);
        }
    }

    // Đóng statement
    $stmt_ct->close();
}

public function updateSoLuongSanPham($giohang) {
    $conn = $this->connect();
    $stmt = $conn->prepare("UPDATE sanpham SET so_luong = so_luong - ? WHERE id = ?");
    foreach ($giohang as $sp) {
        $soluong_mua = $sp['soluong'];
        $id_sp = $sp['id'];
        $stmt->bind_param("ii", $soluong_mua, $id_sp);
        $stmt->execute();
    }
}
    }
