<?php
require_once 'config/config.php';

class Customer {
    public static function all() {
        $conn = Config::connect();
        return $conn->query("SELECT id, ten_khach_hang FROM khachhang");
    }
}
