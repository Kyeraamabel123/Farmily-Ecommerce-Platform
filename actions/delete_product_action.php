<?php
// Include the product controller
include_once '../controllers/product_controller.php';

// Checking if the 'id' parameter is being passed via GET method
if (isset($_GET['id'])) {

    // Storing the passed product ID in a variable
    $product_id = $_GET['id'];

    // Checking if the request method is GET (used for deletion)
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        // Calling the controller function to delete the product
        if (deleteProductController($product_id)) {

            // Redirecting to the product view page if deletion is successful
            header('Location: ../view/product.php');
        } else {

          
            header('Location: ../views/view_product.php?error=Error deleting product');
        }
    }
} else {
    // Handling case where the product ID is not provided
    die("Invalid product ID.");
}
?>
