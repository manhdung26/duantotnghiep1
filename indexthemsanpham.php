<?php
require_once 'config/config.php';

$controller = $_GET['controller'] ?? 'them_sanpham';
$action = $_GET['action'] ?? 'create';

$controllerFile = 'Controller/Controller' . ucfirst($controller) . '.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $className = 'Controller' . ucfirst($controller);

    if (class_exists($className)) {
        $controllerObject = new $className;

        if (method_exists($controllerObject, $action)) {
            $controllerObject->$action();
        } else {
            echo "Lỗi: Phương thức '$action' không tồn tại trong $className";
        }
    } else {
        echo "Lỗi: Lớp '$className' không tồn tại";
    }
} else {
    echo "Lỗi: File '$controllerFile' không tồn tại";
}
?>
