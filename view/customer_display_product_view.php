<?php
session_start();
require_once('../controllers/cart_controller.php');

// Check if the user is logged in and retrieve the cart count
$cartCount = 0; 
if (isset($_SESSION['customer_id'])) {
    $cartController = new CartController();
    $cartCount = $cartController->getItemCount($_SESSION['customer_id']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <!-- Bootstrap CSS and Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/display_product_to_customer.css">
</head>
<body>

<!-- Navigation bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Farmily</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">
                        <i class="bi bi-person-circle"></i> My Account
                    </a>
                </li>

                <li class="nav-item dropdown">
          
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-grid"></i> Categories
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="fresh_fruits.php">Fresh Fruits</a></li>
        <li><a class="dropdown-item" href="vegetables.php">Vegetables</a></li>
        <li><a class="dropdown-item" href="fresh_herbs.php">Fresh Herbs</a></li>
    </ul>
</li>


<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="brandsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-tags"></i> Brands
    </a>
    <ul class="dropdown-menu" aria-labelledby="brandsDropdown">
        <li><a class="dropdown-item" href="del_monte.php">Del Monte</a></li>
        <li><a class="dropdown-item" href="fresh_herbs.php">Fresh Herbs</a></li>
        <li><a class="dropdown-item" href="farm_vegete.php">Farm Vegete</a></li>
    </ul>
</li>

<li class="nav-item">
    <a class="nav-link" href="../view/view_cart_page.php">
        <i class="bi bi-cart"></i> Cart
        <span id="cartCountBadge" class="badge bg-danger"><?php echo $cartCount; ?></span>
    </a>
</li>


                <li class="nav-item">
                    <a class="nav-link" href="../index.php">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main content -->
<div class="container mt-5">
    <h1 class="text-center mb-5">Our Products</h1>
    <div class="row">
        <?php
        require_once('../controllers/display_product_to_customer_cntroller.php');

        // Looping through the products and display them
        if ($products) {
            foreach ($products as $product) {
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card product-card h-100 shadow-sm">
                        <img src="<?php echo htmlspecialchars($product['product_image']); ?>" class="card-img-top product-img" alt="<?php echo htmlspecialchars($product['product_title']); ?>">
                        <div class="card-body">
                            <h5 class="card-title product-title"><?php echo htmlspecialchars($product['product_title']); ?></h5>
                            <p class="card-text product-desc"><?php echo htmlspecialchars($product['product_desc']); ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="card-text text-muted">
                                    <strong>Price:</strong> $<?php echo number_format($product['product_price'], 2); ?>
                                </p>
                                <div class="product-rating">
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star-half-alt text-warning"></i>
                                    <i class="far fa-star text-warning"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0 d-flex justify-content-between align-items-center">
                            <!-- Add to Cart Link -->
                            <a href="../actions/add_to_cart_action.php" class="btn btn-primary add-to-cart" 
                               data-pid="<?php echo htmlspecialchars($product['product_id']); ?>" 
                               data-cid="<?php echo htmlspecialchars($_SESSION['customer_id']); ?>" 
                               data-qty="1">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </a>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p class='text-center'>No products found.</p>";
        }
        ?>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Add to Cart Script -->
<script>
document.querySelectorAll('.add-to-cart').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault(); // Prevent the default anchor behavior

        const p_id = this.getAttribute('data-pid');
        const c_id = this.getAttribute('data-cid');
        const qty = this.getAttribute('data-qty');

        // Create a form to submit the data via POST
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '../actions/add_to_cart_action.php';

        // Create hidden inputs for the product ID, customer ID, and quantity
        const pIdInput = document.createElement('input');
        pIdInput.type = 'hidden';
        pIdInput.name = 'p_id';
        pIdInput.value = p_id;

        const cIdInput = document.createElement('input');
        cIdInput.type = 'hidden';
        cIdInput.name = 'c_id';
        cIdInput.value = c_id;

        const qtyInput = document.createElement('input');
        qtyInput.type = 'hidden';
        qtyInput.name = 'qty';
        qtyInput.value = qty;

        // Append the inputs to the form
        form.appendChild(pIdInput);
        form.appendChild(cIdInput);
        form.appendChild(qtyInput);

        // Append the form to the body and submit it
        document.body.appendChild(form);
        form.submit();
    });
    
});
</script>

</body>
</html>
