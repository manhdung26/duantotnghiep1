<?php
require_once 'config/config.php';

class ModelSanpham {
    private $conn;

    public function __construct() {
        $this->conn = Config::connect();
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM sanpham WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function update($id, $data, $files) {
        $columns = "ten = ?, gia = ?, mota = ?, so_luong = ?, luot_ban = ?, noi_bat = ?";
        $params = [$data['ten'], $data['gia'], $data['mota'], $data['so_luong'], $data['luot_ban'], isset($data['noi_bat']) ? 1 : 0];

        // Ảnh chính
        if (!empty($files['anh']['name'])) {
            $filename = $files['anh']['name'];
            move_uploaded_file($files['anh']['tmp_name'], 'img/' . $filename);
            $columns .= ", anh = ?";
            $params[] = $filename;
        }

        $sql = "UPDATE sanpham SET $columns WHERE id = ?";
        $params[] = $id;

        $stmt = $this->conn->prepare("UPDATE sanpham SET $columns WHERE id = ?");
        $types = str_repeat("s", count($params) - 1) . "i";
        $stmt->bind_param($types, ...$params);
        $stmt->execute();

        // Ảnh phụ
        for ($i = 2; $i <= 4; $i++) {
            if (!empty($files["anh$i"]['name'])) {
                $filename = $files["anh$i"]['name'];
                move_uploaded_file($files["anh$i"]['tmp_name'], 'img/' . $filename);
                $stmt = $this->conn->prepare("UPDATE sanpham SET anh$i = ? WHERE id = ?");
                $stmt->bind_param("si", $filename, $id);
                $stmt->execute();
            }
        }

        return true;
    }
}
