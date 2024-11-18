<?php
include_once '../classes/category_class.php'; 

// This is Controller to add a category
function addCategoryController($name) {
    $category = new Category(); 
    return $category->addCategory($name); 
}

// This is Controller to delete a category by id
function deleteCategoryController($id) {
    $category = new Category();  
    return $category->deleteCategory($id); 
}

// This is Controller to get all categories
function viewCategoriesController() {
    $category = new Category(); 
    return $category->getCategories(); 
}

// This is Controller to update a category
function updateCategoryController($id, $name) {
    $category = new Category(); 
    return $category->editCategory($id, $name); 
}

// This is Controller to get a category by ID (for editing purposes)
function getCategoryByIdController($id) {
    $category = new Category();  
    return $category->getCategoryById($id); 
}
?>
