<?php
require_once('../settings/db_class.php');

class Cart extends db_connection {

    // Add item to the cart
    public function addItem($p_id, $c_id, $qty) {

        // Checking if the item is already in the cart
        if ($this->itemExists($p_id, $c_id)) {
            return "Product is already in the cart. Please update the quantity.";
        } else {
            // Inserting new item
            $sql = "INSERT INTO cart (p_id, c_id, qty) VALUES (?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("iii", $p_id, $c_id, $qty);
            if ($stmt->execute()) {
                return "Product added to cart successfully.";
            } else {
                return "Error adding product to cart.";
            }
        }
    }

    // Checking if the item already exists in the cart
    private function itemExists($p_id, $c_id) {
        $sql = "SELECT * FROM cart WHERE p_id = ? AND c_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $p_id, $c_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    // Updating the quantity of an item in the cart
    public function updateItem($p_id, $c_id, $qty) {
        $sql = "UPDATE cart SET qty = ? WHERE p_id = ? AND c_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("iii", $qty, $p_id, $c_id);
        return $stmt->execute();
    }

    // Deleting item from cart
    public function deleteItem($p_id, $c_id) {
        $sql = "DELETE FROM cart WHERE p_id = ? AND c_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $p_id, $c_id);
        if (!$stmt->execute()) {
            error_log("Failed to delete item: " . $stmt->error); 
            return false; 
        }
        return true;
    }

    // Retrieving all items in the cart for a specific customer along with product details
    public function getItems($c_id) {
        $sql = "SELECT c.qty, p.product_id, p.product_image 
                FROM cart c 
                JOIN products p ON c.p_id = p.product_id 
                WHERE c.c_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $c_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Geting total cost of items in the cart
    public function getTotalCost($c_id) {
        $sql = "SELECT SUM(p.product_price * c.qty) AS total_cost 
                FROM cart c 
                JOIN products p ON c.p_id = p.product_id 
                WHERE c.c_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $c_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result ? $result['total_cost'] : 0;
    }

    public function getItemCount($c_id) {
        $sql = "SELECT SUM(qty) AS total_items FROM cart WHERE c_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $c_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result ? $result['total_items'] : 0;
    }
    
}

?>
