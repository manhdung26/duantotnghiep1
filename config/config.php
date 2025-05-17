<?php
class Config {
    public static function connect() {
        $conn = new mysqli("localhost", "root", "", "detaitotnghiep");

        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        return $conn;
    }
}
?>
