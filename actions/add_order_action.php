<?php
session_start(); 
require_once('../controllers/order_controller.php');
include('../controllers/cart_controller.php');
$cartItems= getItems();

// Get data from POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = $_POST['user_id'];
    $invoice = rand(1000000, 9999999); 
    $order_date = date('Y-m-d'); 
    $status = 'Pending'; 


    $addingOrder = addOrderController($customer_id, $invoice, $order_date, $status);

    if ($ $addingOrder !== false) {
        // Redirecting to cart page or show success message
        header('Location: ../view/checkout.php'); 
        exit; 
    } else {
        header('Location: ../view/checkout.php?error=Failed to add item'); 
        exit; 
    }
} 
?>
