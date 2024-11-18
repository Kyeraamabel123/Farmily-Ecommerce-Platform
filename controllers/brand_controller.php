<?php
include_once '../classes/brand_class.php'; 

// This is Controller to add a brand
function addBrandController($name, $description) {
    $brand = new Brand(); 
    return $brand->addBrand($name, $description); 
}

// This is Controller to delete a brand by id
function deleteBrandController($id) {
    $brand = new Brand(); 
    return $brand->deleteBrand($id); 
}

// This is Controller to get all brands
function viewBrandsController() {
    $brand = new Brand();  
    return $brand->getBrands(); 
}

/// This is Controller to update a brand (name and description)
function updateBrandController($id, $name, $description) {
    $brand = new Brand(); 
    return $brand->updateBrand($id, $name, $description); 
}

// This is Controller to get a brand by ID (for editing purposes)
function getBrandByIdController($id) {
    $brand = new Brand();  
    return $brand->getBrandById($id); 
}
?>
