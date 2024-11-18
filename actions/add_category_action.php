<?php
include_once '../controllers/category_controller.php'; 

// Checking if the submit button is being clicked
if (isset($_POST['submit'])) {
    // Retrieving the category name from the form input
    $name = $_POST['cat_name'];
    
    // Calling the controller function to add the category
    if (addCategoryController($name)) {
        header('Location: ../view/category.php'); 
    } else {
        header('Location: ../view/category.php'); 
    }
}
?>
