<?php
$conn = new mysqli("localhost", "root", "", "detaitotnghiep");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM donhang WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: donhang.php");
        exit();
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>
