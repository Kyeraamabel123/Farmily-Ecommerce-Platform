<?php
require_once('../settings/db_class.php');

class Customer extends db_connection {
    public function loginController($email, $password) {
        $sql = "SELECT * FROM customer WHERE customer_email = ? LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $customer = $result->fetch_assoc();

            // Verifing the password
            if (password_verify($password, $customer['customer_pass'])) {
                return $customer; // This returns customer data if successful
            } else {
                return false; // This prompts customer if Invalid password is entered
            }
        } else {
            return false; // This prompts customer if  Email not found
        }
    }
}
?>
