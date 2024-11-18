<?php
session_start(); 
require_once('../controllers/cart_controller.php');

// Get data from POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $p_id = $_POST['p_id'];
    $c_id = $_SESSION['customer_id']; 
    $qty = $_POST['qty']; 

    $cartController = new CartController();
    $result = $cartController->addItem($p_id, $c_id, $qty);

    if ($result) {
        // Redirecting to cart page or show success message
        header('Location: ../view/view_cart_page.php'); 
        exit; 
    } else {
        header('Location: ../view/customer_display_product_view.php?error=Failed to add item'); 
        exit; 
    }
} 
?>
