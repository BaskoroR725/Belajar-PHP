<?php
require_once __DIR__ . '/../models/ProductModel.php';

class ProductController
{
    public function index(): void
    {
        $model = new ProductModel();
        $products = $model->getAllProducts();

        require __DIR__ . '/../views/product_list.php';
    }
}
