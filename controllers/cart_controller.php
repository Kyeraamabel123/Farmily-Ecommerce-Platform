<?php
require_once('../classes/cart_class.php');

class CartController {
    // Adding an item to the cart
    public function addItem($p_id, $c_id, $qty) {
        $cart = new Cart();
        return $cart->addItem($p_id, $c_id, $qty);
    }

    // Updating the quantity of an item in the cart
    public function updateItem($p_id, $c_id, $qty) {
        $cart = new Cart();
        return $cart->updateItem($p_id, $c_id, $qty);
    }

    // Deleting an item from the cart
    public function deleteItem($p_id, $c_id) {
        $cart = new Cart();
        return $cart->deleteItem($p_id, $c_id);
    }

    // Retrieving all items in the cart for a specific customer
    public function getItems($c_id) {
        $cart = new Cart();
        return $cart->getItems($c_id);
    }

    // Geting total cost of items in the cart
    public function getTotalCost($c_id) {
        $cart = new Cart();
        return $cart->getTotalCost($c_id);
    }

    public function getItemCount($c_id) {
        $cart = new Cart();
        return $cart->getItemCount($c_id);
    }

    
}
?>
