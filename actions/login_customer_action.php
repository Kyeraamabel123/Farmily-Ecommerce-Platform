<?php
session_start();
require_once('../controllers/login_process_controller.php'); // Including the controller

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initializing an array to hold validation errors
    $errors = [];

    // Validating input from users
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Valid email is required.';
    }
    if (empty($_POST['password'])) {
        $errors[] = 'Password is required.';
    }

    // If there are no validation errors, then the user proceeds to login
    if (empty($errors)) {
        // Capturing the email and password
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Calling the login function
        $loginSuccess = loginCustomer($email, $password); // Direct function call

        // Checking if the login was successful
        if ($loginSuccess) {
            // Redirecting to the index page or user dashboard
            header("Location: ../view/customer_display_product_view.php");
            exit();
        } else {
            echo "<p style='color:red;'>Invalid email or password.</p>";
        }
    } 
}
?>
