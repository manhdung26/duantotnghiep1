<?php
require_once "models/modelsSP.php";

class SanPhamController {
    public function index() {
    $model = new SanPhamModel();
    $search = $_GET['search'] ?? '';
    $status = $_GET['status'] ?? '';
    $category = $_GET['category'] ?? '';

    $sanphams = $model->getAll($search, $status, $category);
    $categories = $model->getAllCategories();

    include "view/viewSP.php";
}
}
