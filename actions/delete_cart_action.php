<?php
session_start(); 
require_once('../controllers/cart_controller.php');

// Get data from POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $p_id = $_POST['p_id']; 
    $c_id = $_POST['c_id']; 

    $cartController = new CartController();
    $result = $cartController->deleteItem($p_id, $c_id);

    // Redirect or return a response
    if ($result) {
        header("Location: ../view/view_cart_page.php"); 
        exit; 
    } else {
        // Handling error 
        header("Location: ../view/cart_view.php?error=Failed to remove item"); 
        exit; 
    }
} else {
    // If not a POST request, redirect to the cart view
    header("Location: ../view/cart_view.php");
    exit; 
}
?>
