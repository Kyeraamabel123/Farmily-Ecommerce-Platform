<?php
include('../controllers/product_controller.php');

// Fetching products to display
$products = viewProductsController(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="../css/product.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
   
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Product Management</h2>
        
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#productModal" onclick="resetForm()">
            <i class="fas fa-plus"></i> Add Product
        </button>
        
        <div class="table-responsive mt-4">
            <table class="table table-striped table-hover product-table">
                <thead class="table-light">
                    <tr>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Keywords</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= $product['cat_name'] ?></td>
                            <td><?= $product['brand_name'] ?></td>
                            <td><?= $product['product_title'] ?></td>
                            <td><?= number_format($product['product_price'], 2) ?> USD</td>
                            <td><?= htmlspecialchars($product['product_desc']) ?></td>
                            <td><img src='<?= $product['product_image'] ?>' class='product-image' alt='Product Image'></td>
                            <td><?= htmlspecialchars($product['product_keywords']) ?></td>
                            <td>
                                <button class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#productModal' onclick='editProduct(<?= $product['product_id'] ?>)'>
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <a href='../actions/delete_product_action.php?id=<?= $product['product_id'] ?>' class='btn btn-danger btn-sm' onclick='return confirm("Are you sure you want to delete this product?");'>
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="productForm" action="../actions/add_product_action.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="productModalLabel">Add Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="product_id" name="product_id">

                            <!-- Categories Selection -->
                            <div class="mb-3">
                                <label for="productCat" class="form-label">Select Category:</label>
                                <select class="form-select" name="product_cat" id="productCat" required>
                                    <option value="">Select a category</option>
                                    <?php
                                    require_once '../classes/product_class.php';
                                    $product = new Product();
                                    $categories = $product->getAllCategories(); 
                                    foreach ($categories as $category) {
                                        echo "<option value='" . $category['cat_id'] . "'>" . htmlspecialchars($category['cat_name']) . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Brands Selection -->
                            <div class="mb-3">
                                <label for="productBrand" class="form-label">Select Brand:</label>
                                <select class="form-select" name="product_brand" id="productBrand" required>
                                    <option value="">Select a brand</option>
                                    <?php
                                    $brands = $product->getAllBrands();
                                    foreach ($brands as $brand) {
                                        echo "<option value='" . $brand['brand_id'] . "'>" . htmlspecialchars($brand['brand_name']) . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="product_title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="product_title" name="product_title" required>
                            </div>
                            <div class="mb-3">
                                <label for="product_price" class="form-label">Price</label>
                                <input type="number" step="0.01" class="form-control" id="product_price" name="product_price" required>
                            </div>
                            <div class="mb-3">
                                <label for="product_desc" class="form-label">Description</label>
                                <textarea class="form-control" id="product_desc" name="product_desc" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="product_image" class="form-label">Upload Image</label>
                                <input type="file" class="form-control" id="product_image" name="product_image" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="product_keywords" class="form-label">Keywords</label>
                                <input type="text" class="form-control" id="product_keywords" name="product_keywords" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" id="submit_button">Add Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    const productModal = new bootstrap.Modal(document.getElementById('productModal'));

    window.editProduct = function(productId) {
        const product = <?php echo json_encode($products); ?>.find(p => p.product_id == productId);

        document.getElementById('product_id').value = product.product_id;
        document.getElementById('product_title').value = product.product_title;
        document.getElementById('product_price').value = product.product_price;
        document.getElementById('product_desc').value = product.product_desc;
        document.getElementById('product_keywords').value = product.product_keywords;
        document.getElementById('productCat').value = product.cat_id; 
        document.getElementById('productBrand').value = product.brand_id; 

        // Setting form action and button text to edit
        document.getElementById('productModalLabel').innerText = "Edit Product";
        document.getElementById('productForm').action = "../actions/edit_product_action.php";
        document.getElementById('submit_button').innerText = "Update Product"; 

        productModal.show();
    }

    // Resetting the form when opening the modal for adding a new product
    window.resetForm = function() {
        document.getElementById('productForm').reset();
        document.getElementById('product_id').value = '';
        document.getElementById('productModalLabel').innerText = "Add Product";
        document.getElementById('productForm').action = "../actions/add_product_action.php";
        document.getElementById('submit_button').innerText = "Add Product"; 
    }
});
</script>
</body>
</html>
