<?php
require('../classes/register_customer_class.php');

$customer = new Customer();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initializing an array to hold validation errors
    $errors = [];

    // Validating inputs
    if (empty($_POST['customer_name'])) {
        $errors[] = 'Name is required.';
    }
    if (empty($_POST['customer_email']) || !filter_var($_POST['customer_email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Valid email is required.';
    }
    if (empty($_POST['customer_pass']) || strlen($_POST['customer_pass']) < 6) {
        $errors[] = 'Password must be at least 6 characters long.';
    }
    if (empty($_POST['customer_country'])) {
        $errors[] = 'Country is required.';
    }
    if (empty($_POST['customer_city'])) {
        $errors[] = 'City is required.';
    }
    if (empty($_POST['customer_contact']) || !preg_match('/^\d{10,15}$/', $_POST['customer_contact'])) {
        $errors[] = 'Valid contact number is required.';
    }

    // If there are no validation errors, then we proceed to add the customr
    if (empty($errors)) {

        // Handling image upload
        $customer_image = null;
        if (isset($_FILES['customer_image']) && $_FILES['customer_image']['error'] == UPLOAD_ERR_OK) {
            $upload_dir = 'images/';
            
            // Checking if the directory exists, if not, create it
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true); // Create directory with proper permissions
            }
            
            // Defining the file path
            $customer_image = $upload_dir . basename($_FILES['customer_image']['name']);
            
            // Moving the uploaded file
            if (!move_uploaded_file($_FILES['customer_image']['tmp_name'], $customer_image)) {
                $errors[] = "Failed to upload image.";
            }
        }

        // If there are no upload errors, the we continue to register the user
        if (empty($errors)) {

            // Preparing data for insertion
            $data = [
                'customer_name' => $_POST['customer_name'],
                'customer_email' => $_POST['customer_email'],
                'customer_pass' => password_hash($_POST['customer_pass'], PASSWORD_BCRYPT), // Hash password
                'customer_country' => $_POST['customer_country'],
                'customer_city' => $_POST['customer_city'],
                'customer_contact' => $_POST['customer_contact'],
                'user_role' => 2, // Default user role (e.g., customer)
                'customer_image' => $customer_image,
            ];

            // Adding the customer and check for success
            if ($customer->addCustomer($data)) {

                // Registration successful, then we redirect the user  to the login page
                header('Location: ../view/login_customer.php');
                exit();
            } else {
                echo "Error: " . mysqli_error($customer->db);
            }
        } else {
            // Displaying upload errors
            foreach ($errors as $error) {
                echo "<p style='color:red;'>$error</p>";
            }
        }
    } else {
        // Displaying validation errors
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}
?>
