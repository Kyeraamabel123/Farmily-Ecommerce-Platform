<?php
require('../controllers/product_controller.php');

function addProductAction() {

    // Checking for form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Checking if required fields are set
        if (isset($_POST['product_cat'], $_POST['product_brand'], $_POST['product_title'], $_POST['product_price'], $_POST['product_desc'], $_POST['product_keywords'])) {

            // Collecting data from the POST request
            $category = $_POST['product_cat'];
            $brand = $_POST['product_brand'];
            $title = $_POST['product_title'];
            $price = $_POST['product_price'];
            $desc = $_POST['product_desc'];
            $keywords = $_POST['product_keywords'];

            // Handling image upload
            $image = null; // Initialize image variable
            if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == UPLOAD_ERR_OK) {
                $image = handleImageUpload($_FILES['product_image']);
            }

            // Calling the add product controller
            $result = addProductController($category, $brand, $title, $price, $desc, $image, $keywords);

            // Redirecting based on the result
            if ($result) {
                header('Location: ../view/product.php');
                exit();
            } 
        } 
    }
}

// This Function to handle image upload
function handleImageUpload($file) {
    $target_dir = "../images/";
    $target_file = $target_dir . basename($file["name"]);

    // Checking if the image was uploaded successfully
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return $target_file; 
    }
    return null; 
}

// Calling the add product action
addProductAction();
?>
