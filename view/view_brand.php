<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/view_brand.css"> 
    <script src="../js/view_brand.js" defer></script> 
    <title>Manage Brands</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"> <!-- Ensure this is included -->
</head>
<body>

<div class="container mt-5">
    <!-- Button to Open the Add Brand Modal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addBrandModal">
        <i class="bi bi-plus-circle"></i> Add New Brand
    </button>

    <!-- Table for showing Brands and details -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Brand Name</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include_once '../controllers/brand_controller.php';
            $brands = viewBrandsController(); 

            if ($brands) {
                foreach ($brands as $brand) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($brand['brand_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($brand['brand_description']) . "</td>";
                    echo "<td>
                            <button class='btn btn-warning btn-sm edit-btn' 
                                    data-id='" . $brand['brand_id'] . "' 
                                    data-name='" . htmlspecialchars($brand['brand_name']) . "' 
                                    data-description='" . htmlspecialchars($brand['brand_description']) . "'>
                                <i class='bi bi-pencil-fill'></i> Edit
                            </button>
                            <a href='../actions/delete_brand_action.php?id=" . $brand['brand_id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this brand?\")'>
                                <i class='bi bi-trash-fill'></i> Delete
                            </a>
                        </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No brands found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Add Brand Modal -->
<div class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="addBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBrandModalLabel"><i class="bi bi-plus-circle"></i> Add New Brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../actions/add_brand_action.php" method="POST">
                    <div class="mb-3">
                        <label for="brandName" class="form-label">Brand Name</label>
                        <input type="text" class="form-control" id="brandName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="brandDescription" class="form-label">Description</label>
                        <input type="text" class="form-control" id="brandDescription" name="description" required>
                    </div>
                    <button type="submit" class="btn btn-success" name="submit">
                        <i class="bi bi-plus-square-fill"></i> Add Brand
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Brand Modal -->
<div class="modal fade" id="editBrandModal" tabindex="-1" aria-labelledby="editBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBrandModalLabel"><i class="bi bi-pencil-fill"></i> Edit Brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProductForm" action="../actions/edit_brand_action.php?id=<?php echo $brand['brand_id']; ?>" method="POST">
                    <input type="hidden" id="editBrandId" name="id">
                    <div class="mb-3">
                        <label for="editBrandName" class="form-label">Brand Name</label>
                        <input type="text" class="form-control" id="editBrandName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editBrandDescription" class="form-label">Description</label>
                        <input type="text" class="form-control" id="editBrandDescription" name="description" required>
                    </div>
                    <button type="submit" class="btn btn-success" name="submit">
                        <i class="bi bi-check-square-fill"></i> Update Brand
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-btn');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const brandId = this.getAttribute('data-id');
            const brandName = this.getAttribute('data-name');
            const brandDescription = this.getAttribute('data-description');

            document.getElementById('editBrandId').value = brandId;
            document.getElementById('editBrandName').value = brandName;
            document.getElementById('editBrandDescription').value = brandDescription;

            const editModal = new bootstrap.Modal(document.getElementById('editBrandModal'));
            editModal.show();
        });
    });
});
</script>

</body>
</html>
