<?php
include_once '../controllers/brand_controller.php';

// Checking if the 'id' parameter is being passed via GET method
if (isset($_GET['id'])) {
    // Storing the passed brand ID in a variable
    $id = $_GET['id'];
    
    // Calling the controller function to delete the brand
    if (deleteBrandController($id)) {
        header('Location: ../view/view_brand.php');
    } else {
        header('Location: ../view/view_brand.php');
    }
}
?>
