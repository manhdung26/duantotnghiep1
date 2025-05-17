<?php
require_once 'models/modelsthem_sanpham.php';
require_once 'models/modelsdanhmuc.php';
class ControllerThem_sanpham {
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productModel = new modelsThem_sanpham();
    
            // Xử lý ảnh
            $anh = $this->uploadImage('anh');
            $anh2 = $this->uploadImage('anh2');
            $anh3 = $this->uploadImage('anh3');
            $anh4 = $this->uploadImage('anh4');
    
           $data = [
    'ten' => $_POST['ten'],
    'gia' => $_POST['gia'],
    'so_luong' => $_POST['soluong'],
    'mota' => $_POST['mota'],
    'anh' => $anh,
    'anh2' => $anh2,    
    'anh3' => $anh3,
    'anh4' => $anh4,
    'chatlieu' => $_POST['chatlieu'] ?? '',
    'kichthuoc' => $_POST['kichthuoc'] ?? '',
    'mausac' => $_POST['mausac'] ?? '',
    'baohanh' => $_POST['baohanh'] ?? '',
    'thuonghieu' => $_POST['thuonghieu'] ?? '',
    'danhmuc_id' => $_POST['danhmuc_id'] ?? null
];
    
            if ($productModel->create($data)) {
                // Thêm sản phẩm thành công, chuyển hướng về trang danh sách sản phẩm
                header('Location: indexSP.php?controller=sanpham'); // Điều chỉnh URL theo nhu cầu của bạn
                exit; // Đảm bảo không có mã thêm sau khi header đã được gửi
            } else {
                echo "Thêm sản phẩm thất bại.";
            }
        } else {
    // Load danh mục
    $danhmucModel = new modelDanhmuc();
    $danhmucs = $danhmucModel->getAllDanhmuc();
    require 'view/viewthem_sanpham.php';
}
    }

    private function uploadImage($inputName) {
        if (isset($_FILES[$inputName]) && $_FILES[$inputName]['name']) {
            $target = 'img/' . basename($_FILES[$inputName]['name']);
            move_uploaded_file($_FILES[$inputName]['tmp_name'], $target);
            return $_FILES[$inputName]['name'];
        }
        return '';
    }
}
