<?php
require_once('../controllers/cart_controller.php');

// Geting data from POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $p_id = $_POST['p_id'];
    $c_id = $_POST['c_id']; 
    $qty = $_POST['qty'];    

    $cartController = new CartController();
    $result = $cartController->updateItem($p_id, $c_id, $qty);

    // Redirecting or return a response
    if ($result) {
        // Redirecting to cart page or show success message
        header("Location: ../view/view_cart_page.php");
    } else {
       header("Location: cart.php?error=Failed to update item quantity");
    }
}
?>
