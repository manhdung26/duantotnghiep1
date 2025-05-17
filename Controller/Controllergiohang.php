    <?php
    require_once 'models/modelsgiohang.php';

    class ControllerGiohang {
        private $model;

        public function __construct($db) {
            $this->model = new modelsGiohang($db);
        }

      public function handleRequest() {
    if (isset($_POST['add_to_cart'])) {
        $this->model->addToCart($_POST['product_id']);
    }

    if (isset($_GET['remove'])) {
        $this->model->removeFromCart($_GET['remove']);
    }

    if (isset($_POST['update_cart']) && isset($_POST['quantity'])) {
        $this->model->updateCart($_POST['quantity']);
    }

    // Lấy giỏ hàng và tổng tiền
    $cart = $this->model->getCart();
    $total = $this->model->getTotal();

    include 'view/viewgiohang.php';
}}