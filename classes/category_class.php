<?php
require_once('../settings/db_class.php');

class Category extends db_connection {

    // Adding a new category
    public function addCategory($name) {
        $stmt = $this->db->prepare("INSERT INTO categories (cat_name) VALUES (?)");
        $stmt->bind_param('s', $name);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Editing an existing category
    public function editCategory($id, $name) {
        $stmt = $this->db->prepare("UPDATE categories SET cat_name = ? WHERE cat_id = ?");
        $stmt->bind_param('si', $name, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Deleting a category by id
    public function deleteCategory($id) {
        $stmt = $this->db->prepare("DELETE FROM categories WHERE cat_id = ?");
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Getting all categories
    public function getCategories() {
        $sql = "SELECT * FROM categories";
        $result = $this->db_query($sql); 
        return mysqli_fetch_all($this->results, MYSQLI_ASSOC);
    }

    // Getting category by ID
    public function getCategoryById($id) {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE cat_id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $category = $result->fetch_assoc();
        $stmt->close();
        return $category;
    }
}
?>
