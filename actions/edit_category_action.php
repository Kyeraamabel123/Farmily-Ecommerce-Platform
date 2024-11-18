<?php
include_once '../controllers/category_controller.php'; 

// Checking if the 'id' parameter is being passed via GET method
if (isset($_GET['cat_id'])) {
    // Storing the passed category ID in a variable
    $id = $_GET['cat_id'];

    // Checking if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['cat_name'];
        
        // Calling the controller function to update the category
        if (updateCategoryController($id, $name)) {
            header('Location: ../view/category.php'); 
            exit; // Ensure no further code is executed
        } 
    } 
}
?>
