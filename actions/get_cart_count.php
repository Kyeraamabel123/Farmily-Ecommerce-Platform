<?php
session_start();
require_once('../controllers/cart_controller.php');

if (isset($_SESSION['customer_id'])) {
    $c_id = $_SESSION['customer_id'];
    $cartController = new CartController();
    $itemCount = $cartController->getItemCount($c_id);
    echo json_encode(['count' => $itemCount]);
} else {
    echo json_encode(['count' => 0]);
}
?>
