<?php
require_once __DIR__ . '/helpers/functions.php';
require_once __DIR__ . '/controllers/ProductController.php';

$products = getProducts();

require_once __DIR__ . '/views/product_list.php';
