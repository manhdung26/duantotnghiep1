<?php
class modelsLogin {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function checkLogin($username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc(); // trả về mảng chứa thông tin user nếu có, ngược lại trả về null
    }
}
