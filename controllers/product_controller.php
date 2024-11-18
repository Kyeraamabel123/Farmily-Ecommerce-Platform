<?php
require('../classes/product_class.php');

// This is Function to add a product
function addProductController($category, $brand, $title, $price, $desc, $image, $keywords) {
    $productModel = new Product(); 
    return $productModel->addProduct($category, $brand, $title, $price, $desc, $image, $keywords);
}

// This is Function to edit a product
function editProductController($product_id, $category, $brand, $title, $price, $desc, $image, $keywords) {
    $productModel = new Product();  
    return $productModel->editProduct($product_id, $category, $brand, $title, $price, $desc, $image, $keywords);
}

// This is Function to delete a product by ID
function deleteProductController($product_id) {
    $productModel = new Product(); 
    return $productModel->deleteProduct($product_id);
}

// This is Function to view all products
function viewProductsController() {
    $productModel = new Product(); 
    return $productModel->viewProducts();
}

// This is Function to get a product by ID
function getProductByIdController($product_id) {
    $productModel = new Product(); 
    return $productModel->getProductById($product_id);
}
?>
