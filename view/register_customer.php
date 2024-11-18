<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../css/register_customer.css"> 
    <script src="../js/register_customer.js" defer></script> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.css" /> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script> 
    
    <style>
        .form-group {
            margin-bottom: 10px; 
        }
       
        #contact {
            width: 100%;
        }
    </style>

</head>
<body>
    <h1>Register to Shop</h1>
    <form action="../actions/register_customer_action.php" method="POST" enctype="multipart/form-data" id="registration-form">
        <div class="form-group">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="customer_name" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="customer_email" required>
            <small id="email_error" style="color:red;"></small>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="customer_pass" required>
        </div>

        <div class="form-group">
            <label for="country">Country:</label>
            <input type="text" id="country" name="customer_country" required>
        </div>

        <div class="form-group">
            <label for="city">City:</label>
            <input type="text" id="city" name="customer_city" required>
        </div>

        <div class="form-group">
            <label for="contact">Contact:</label>
            <input type="tel" id="contact" name="customer_contact" required> <!-- Phone input field -->
        </div>

        <div class="form-group">
            <label for="image">Profile Image:</label>
            <input type="file" id="image" name="customer_image">
        </div>

        <div class="form-group">
            <label for="user_role">User Role:</label>
            <select id="user_role" name="user_role" required>
                <option value="2">Customer</option>
                <option value="1">Admin</option>
            </select>
        </div>

        <button type="submit">Register</button>
    </form>

    <p>Already registered? <a href="../view/login_customer.php">Login here</a></p>



    
    <script>
        const phoneInputField = document.querySelector("#contact");

        // Initializing the intl-tel-input plugin
        const phoneInput = window.intlTelInput(phoneInputField, {
            initialCountry: "auto", // This auto-detect user's country
            geoIpLookup: function (callback) {
                fetch('https://ipinfo.io/json', {headers: {'Accept': 'application/json'}})
                    .then(response => response.json())
                    .then(data => callback(data.country))
                    .catch(() => callback('US'));
            },
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.js", // This is utilities script for validation and formatting
        });

        // Form validation and submission
        document.querySelector('form').addEventListener('submit', function(event) {
            if (!phoneInput.isValidNumber()) {
                alert("Invalid phone number. Please enter a valid phone number.");
                event.preventDefault(); // Prevent form submission
            } else {
                // This format the phone number in E.164 format before submitting
                const phoneNumber = phoneInput.getNumber(); 
                document.querySelector("#contact").value = phoneNumber; 
            }
        });
    </script>
</body>
</html>
