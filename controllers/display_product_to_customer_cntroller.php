<?php
require_once('../classes/display_product_to_customer_class.php');

// Instantiating the Product class
$productModel = new Product();
$products = $productModel->getAllProducts();
?>
