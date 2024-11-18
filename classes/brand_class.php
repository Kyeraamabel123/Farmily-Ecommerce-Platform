<?php
require_once('../settings/db_class.php');

class Brand extends db_connection {

    // Adding a new brand
    public function addBrand($name, $description) {
        $stmt = $this->db->prepare("INSERT INTO brands (brand_name, brand_description) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $description);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Deleting a brand by id
    public function deleteBrand($id) {
        $stmt = $this->db->prepare("DELETE FROM brands WHERE brand_id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Getting all brands
    public function getBrands() {
        $sql = "SELECT * FROM brands";
        $result = $this->db_query($sql); 
        return mysqli_fetch_all($this->results, MYSQLI_ASSOC);
    }

    // Get a brand by ID
    public function getBrandById($id) {
        $stmt = $this->db->prepare("SELECT * FROM brands WHERE brand_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $brand = $result->fetch_assoc();
        $stmt->close();
        return $brand;
    }

    // Updating a brand by ID
    public function updateBrand($id, $name, $description) {
        $stmt = $this->db->prepare("UPDATE brands SET brand_name = ?, brand_description = ? WHERE brand_id = ?");
        $stmt->bind_param("ssi", $name, $description, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}
?>
