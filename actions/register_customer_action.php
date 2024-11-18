<?php
require('../controllers/register_process_controller.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer = new Customer();

    // Handling image upload
    $customer_image = null;
    if (isset($_FILES['customer_image']) && $_FILES['customer_image']['error'] == UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif']; 
        $file_type = mime_content_type($_FILES['customer_image']['tmp_name']);
        
        if (in_array($file_type, $allowed_types)) {
            $upload_dir = 'images/';
            $customer_image = $upload_dir . basename($_FILES['customer_image']['name']);
            move_uploaded_file($_FILES['customer_image']['tmp_name'], $customer_image);
        } else {
            die("Invalid file type. Only JPG, PNG, and GIF are allowed.");
        }
    }

    // Ensuring all required fields are present
    if (empty($_POST['customer_email']) || empty($_POST['customer_pass']) || empty($_POST['customer_name'])) {
        die("All required fields must be filled out.");
    }

    // Validating email format
    if (!filter_var($_POST['customer_email'], FILTER_VALIDATE_EMAIL)) {
        die("Please enter a valid email address.");
    }

    // Hashing the password before storing it
    $hashed_password = password_hash($_POST['customer_pass'], PASSWORD_BCRYPT);

    // Preparing data for insertion
    $data = [
        'customer_name' => $_POST['customer_name'],
        'customer_email' => $_POST['customer_email'],
        'customer_pass' => $hashed_password,
        'customer_country' => $_POST['customer_country'],
        'customer_city' => $_POST['customer_city'],
        'customer_contact' => $_POST['customer_contact'],
        'user_role' => 2, 
        'customer_image' => $customer_image,
    ];

    // Adding customer and handle the result
    if ($customer->addCustomer($data)) {
        header("Location: ../view/login_customer.php");
        exit();
    } else {
        echo "Error during registration. Please try again.";
    }
}
?>
