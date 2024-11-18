<?php
require_once('../classes/login_customer_class.php'); // Include the Customer class

// This function handles customer login
function loginCustomer($email, $password) {
    $customer = new Customer(); 
    $customerData = $customer->loginController($email, $password); // Correctly calling the method

    // If login is successful, store customer details in session
    if ($customerData) {
        $_SESSION['customer_id'] = $customerData['customer_id'];
        $_SESSION['user_role'] = $customerData['user_role'];
        return true;  
    }

    return false; 
}
?>
