<?php
require_once('../settings/db_class.php');

class Customer extends db_connection {
    
    // Adding customer method with secure prepared statements
    public function addCustomer($data) {
        $sql = "INSERT INTO customer (customer_name, customer_email, customer_pass, customer_country, customer_city, customer_contact, customer_image, user_role) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        // Preparing the database statement
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(
            "sssssssi", 
            $data['customer_name'], 
            $data['customer_email'], 
            $data['customer_pass'], 
            $data['customer_country'], 
            $data['customer_city'], 
            $data['customer_contact'], 
            $data['customer_image'], 
            $data['user_role']
        );
        
        // Executing the query and return the result
        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Database error: " . $stmt->error);
            return false;
        }
    }

    // This Function checks if email exists
    public function emailExists($email) {
        $sql = "SELECT customer_email FROM customers WHERE customer_email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        // Returning true if email already exists
        return $stmt->num_rows > 0;
    }
}
?>
