<?php
include_once '../controllers/category_controller.php';

// Checking if the 'id' parameter is being passed via GET method
if (isset($_GET['id'])) {
    // Storing the passed category ID in a variable
    $id = $_GET['id'];
    
    // Calling the controller function to delete the category
    if (deleteCategoryController($id)) {
        header('Location: ../view/category.php'); // Redirect on success
    } else {
        header('Location: ../view/category.php'); // Redirect on failure
    }
}
?>
