<?php
session_start();
require_once('../controllers/cart_controller.php');

// Checking if the customer ID is set in the session
if (!isset($_SESSION['customer_id'])) {
    header("Location: ../view/login_customer.php");
    exit; 
}

// Retrieving the customer ID from the session
$c_id = $_SESSION['customer_id'];
$cartController = new CartController();
$items = $cartController->getItems($c_id); 
$totalCost = $cartController->getTotalCost($c_id); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="../css/cart.css"> 
</head>

<body>

    <!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="../view/customer_display_product_view.php">
            <i class="bi bi-arrow-left"></i> Back to shop
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">
                        <i class="bi bi-person-circle"></i> Profile
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

<div class="container mt-5">

    <h2 class="mb-4">Your Shopping Cart</h2>

    <?php if ($items): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td>
                            <img src="<?php echo htmlspecialchars($item['product_image']); ?>" alt="Product Image" style="width: 100px; height: auto;">
                        </td>
                        <td>
                            <form method="post" action="../actions/update_cart_action.php">
                                <input type="number" name="qty" value="<?php echo htmlspecialchars($item['qty']); ?>" min="1" required class="form-control d-inline" style="width: 80px;">
                                <input type="hidden" name="p_id" value="<?php echo htmlspecialchars($item['product_id']); ?>">
                                <input type="hidden" name="c_id" value="<?php echo htmlspecialchars($c_id); ?>">
                                <button type="submit" name="update" class="btn btn-success btn-sm">
                                    <i class="bi bi-pencil-square"></i> Update
                                </button>
                            </form>
                        </td>
                        <td>
                            <form method="post" action="../actions/delete_cart_action.php">
                                <input type="hidden" name="p_id" value="<?php echo htmlspecialchars($item['product_id']); ?>">
                                <input type="hidden" name="c_id" value="<?php echo htmlspecialchars($c_id); ?>">
                                <button type="submit" name="delete" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Remove
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h3 class="mt-4">Total Cost: $<?php echo number_format($totalCost, 2); ?></h3>

<!-- Checkout Button -->
<div class="text-end mt-3">
        <a href="../actions/add_order_action.php" class="btn btn-primary btn-lg">
            Proceed to Checkout
        </a>
    </div>

    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
