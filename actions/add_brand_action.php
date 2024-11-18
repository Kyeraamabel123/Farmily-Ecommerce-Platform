<?php
include_once '../controllers/brand_controller.php';

// Checking if the submit button is being clicked
if (isset($_POST['submit'])) {
    // Retrieving the brand name and description from the form input
    $name = $_POST['name'];
    $description = $_POST['description'];
    
    // Calling the controller function to add the brand
       if (addBrandController($name, $description)) {
        header('Location: ../view/view_brand.php');
    } else {
        header('Location: ../view/view_brand.php');
    }
}
?>
