<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Dashboard</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block sidebar">
            <div class="position-sticky">
                <h5>Admin Management</h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="../view/product.php">
                            <i class="fas fa-box"></i> Product Management
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../view/category.php">
                            <i class="fas fa-tags"></i> Category Management
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../view/view_brand.php">
                            <i class="fas fa-flag"></i> Brand Management
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
            <h2>Welcome to the Dashboard</h2>
            <p>Here you can manage products, categories, and brands. Use the sidebar to navigate through the different management sections efficiently.</p>
        </main>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Font Awesome JS for Icons -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

</body>
</html>
