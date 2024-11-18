<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/category.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="../js/category.js" defer></script>
   
    <title>Manage Categories</title>
</head>

<body>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Manage Categories</h1>
        <!-- Button to Open the Add Category Modal -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            <i class="bi bi-plus-circle"></i> Add New Category
        </button>

        <!-- Table for displaying Categories and their actions -->
        <table class="table table-striped table-bordered">
            <thead class="table-header">
                <tr>
                    <th scope="col">Category Name</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once '../controllers/category_controller.php';
                $categories = viewCategoriesController(); // Fetch all categories

                if ($categories) {
                    foreach ($categories as $index => $category) {
                        // Alternate row styles for better readability
                        $rowClass = $index % 2 === 0 ? 'table-row-light' : 'table-row-dark';
                        echo "<tr class='$rowClass'>";
                        echo "<td>" . htmlspecialchars($category['cat_name']) . "</td>";
                        echo "<td class='text-center'>
                                <button class='btn btn-warning btn-sm edit-btn' 
                                        data-id='" . $category['cat_id'] . "' 
                                        data-name='" . htmlspecialchars($category['cat_name']) . "'>
                                    <i class='bi bi-pencil-fill'></i> Edit
                                </button>
                                <a href='../actions/delete_category_action.php?id=" . $category['cat_id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Do you want to delete this category?\")'>
                                    <i class='bi bi-trash-fill'></i> Delete
                                </a>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2' class='text-center'>No categories found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Add Category Form -->
                    <form action="../actions/add_category_action.php" method="POST">
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="categoryName" name="cat_name" required>
                        </div>
                        <button type="submit" class="btn btn-success" name="submit">
                            <i class="bi bi-check-circle"></i> Add Category
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Edit Category Form -->
                    <form id="editCategoryForm" action="../actions/edit_category_action.php" method="POST">
                        <input type="hidden" id="editCategoryId" name="id">
                        <div class="mb-3">
                            <label for="editCategoryName" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="editCategoryName" name="cat_name" required>
                        </div>
                        <button type="submit" class="btn btn-success" name="edit_category">
                            <i class="bi bi-check-circle"></i> Update Category
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // JavaScript to handle editing categories
        document.addEventListener('DOMContentLoaded', () => {
            const editButtons = document.querySelectorAll('.edit-btn');
            editButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const categoryId = button.getAttribute('data-id');
                    const categoryName = button.getAttribute('data-name');

                    // Set values in the edit modal
                    document.getElementById('editCategoryId').value = categoryId;
                    document.getElementById('editCategoryName').value = categoryName;

                    // Show the edit modal
                    const editCategoryModal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
                    editCategoryModal.show();
                });
            });
        });
    </script>

</body>

</html>
