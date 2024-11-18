<?php
include_once '../controllers/brand_controller.php';


if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // Checking if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $name = $_POST['name'];
        $description = $_POST['description'];
        
        if (updateBrandController($id, $name, $description)) {
            header('Location: ../view/view_brand.php');
           
        } else {
            
            header('Location: ../view/view_brand.php');
        
        }
    } 
    }

?>
