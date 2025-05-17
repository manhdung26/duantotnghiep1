<?php
require_once 'config/config.php';

class Order {
    public static function find($id) {
        $conn = Config::connect();
        $stmt = $conn->prepare("SELECT * FROM donhang WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function update($id, $data) {
        $conn = Config::connect();
        $stmt = $conn->prepare("UPDATE donhang SET id_khachhang=?, ten_khach_hang=?, ngay_dat=?, gio_dat=?, tong_tien=?, trang_thai=? WHERE id=?");
        $stmt->bind_param("isssssi", 
            $data['id_khachhang'], 
            $data['ten_khach_hang'], 
            $data['ngay_dat'], 
            $data['gio_dat'], 
            $data['tong_tien'], 
            $data['trang_thai'], 
            $id
        );
        return $stmt->execute();
    }
}
