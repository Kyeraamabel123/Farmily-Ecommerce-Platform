<?php

require("../settings/db_class.php");

class Order extends db_connection
{
    public function add_orders($customer_id, $invoice_id, $order_date, $status)
    {
        // Sanitize input
        $customer_id = mysqli_real_escape_string($this->db, $customer_id);
        $invoice_id = mysqli_real_escape_string($this->db, $invoice_id);
        $order_date = mysqli_real_escape_string($this->db, $order_date);
        $status = mysqli_real_escape_string($this->db, $status);

        // Correct SQL syntax: remove single quotes around column names
        $sql = "INSERT INTO orders (customer_id, invoice_id, order_date, status) 
                VALUES ('$customer_id', '$invoice_id', '$order_date', '$status')";

        // Execute query and check for success
        if ($this->db_query($sql)) {
            $insert_id = $this->get_insert_id();
            if ($insert_id > 0) {
                return $insert_id;
            } else {
                error_log("Error");
                return false;
            }
        } else {
            return false;
        }
    }

    public function add_order_details($order_id, $product_id, $qty)
    {
        // Sanitize input
        $order_id = mysqli_real_escape_string($this->db, $order_id);
        $product_id = mysqli_real_escape_string($this->db, $product_id);
        $qty = mysqli_real_escape_string($this->db, $qty);

        // Correct SQL syntax: remove single quotes around column names
        $sql = "INSERT INTO orderdetails (order_id, product_id, qty) 
                VALUES ('$order_id', '$product_id', '$qty')";
        
        // Execute the query
        return $this->db_query($sql);
    }
}
