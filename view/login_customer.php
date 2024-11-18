<!-- login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to Farmily</title>
    <link rel="stylesheet" href="../css/login_customer.css">
    <script src="../js/login_customer.js" defer></script> 
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form id="loginForm" method="POST" action="../actions/login_customer_action.php">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" >Login</button>
        </form>

        <p>Not registered? <a href="../view/register_customer.php">Click here to register</a></p>
    </div>

</body>
</html>
