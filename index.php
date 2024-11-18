<?php
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmily - Your Local Farm Marketplace</title>
    <link rel="stylesheet" href="css/index.css">
   
</head>
<body>
    <header>
        <h1>Welcome to Farmily</h1>
        <p>Shop with local farmers and producers of fresh, organic, and sustainable produce.</p>

        <nav>
            <ul>
                
                <?php ?>
                    
                    <li><a href="view/login_customer.php">Login</a></li>
                    <li><a href="view/register_customer.php">Register</a></li>
                <?php ?>
            </ul>
        </nav>
    </header>

    <main>
        
        <section>
            <h2>Featured Products</h2>
            <div class="product-list">
                
                <div class="product-card">
                    <img src="images/indexpageherbs.png" alt="Fresh Organic Tomatoes">
                    <h3>Fresh Organic Herbs</h3>
                    <p>Price: $3.00</p>
                    <a href="#">Shop Now</a>
                </div>
                
                <div class="product-card">
                    <img src="images/indexpagefruits.png" alt="Organic Apples" style="width: 100%; max-width: 300px; height: auto;">
                    <h3>Organic Fruits</h3>
                    <p>Price: $2.50</p>
                    <a href="#">Shop Now</a>
                </div>
                <div class="product-card">
                    <img src="images/veges.png" alt="Fresh tomatoes">
                    <h3>Fresh Vegatables</h3>
                    <p>Price: $1.80</p>
                    <a href="#">Shop Now</a>
                </div>

                <div class="product-card">
                    <img src="images/background.png" alt="Leafy greens" style="width: 100%; max-width: 300px; height: auto;">
                    <h3>Leafy Greens</h3>
                    <p>Price: $2.50</p>
                    <a href="#">Shop Now</a>
                </div>
                
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Farmily. All Rights Reserved.</p>
    </footer>
</body>
</html>
