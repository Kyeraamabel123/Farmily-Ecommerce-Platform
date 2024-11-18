<?php

include_once '../controllers/product_controller.php';

// Checking if the 'id' parameter is passed via GET method
if (isset($_GET['id'])) {

    // Storing the passed product ID in a variable
    $product_id = $_GET['id'];

    // Checking if the form has been submitted via POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Collecting form inputs
        $product_cat = $_POST['product_cat'];
        $product_brand = $_POST['product_brand'];
        $product_title = $_POST['product_title'];
        $product_price = $_POST['product_price'];
        $product_desc = $_POST['product_desc'];
        $product_keywords = $_POST['product_keywords'];

        // Handling image upload if a new image was provided
        if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
            $target_dir = "../images/";
            $target_file = $target_dir . basename($_FILES['product_image']['name']);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Checking file type 
            $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
            if (in_array($imageFileType, $allowed_types)) {

                // Moving the uploaded file to the target directory
                if (move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file)) {
                    $product_image = $target_file;
                } else {

                    // Handling error if the file couldn't be moved
                    die("Error uploading image.");
                }
            } else {

                // Handling invalid file type
                die("Invalid image format. Only JPG, JPEG, PNG & GIF files are allowed.");
            }
        } else {
            // Using the existing image if no new image was uploaded
            $product_image = $_POST['existing_image'];
        }

        // Validating inputs before proceeding (expand validation if needed)
        if (!empty($product_cat) && !empty($product_brand) && !empty($product_title) && !empty($product_price) && !empty($product_desc) && !empty($product_keywords)) {
            
            // Calling the controller function to update the product
            if (editProductController($product_id, $product_cat, $product_brand, $product_title, $product_price, $product_desc, $product_image, $product_keywords)) {
            
                header('Location: ../view/product.php');
            } 
        } 
    }
} else {

    // Handling case where the product ID is not provided
    die("Invalid product ID.");
}
?>
