<?php
// Including the database credentials
require('db_cred.php');

// Creating a connection to the database
$connection = mysqli_connect(SERVER, USERNAME, PASSWD, DATABASE);

// Checking if the connection was successful
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    // Displaying a success message when connceted
    echo "<h1>Connected to the Database Successfully!</h1>";
    echo "<p>You are now connected to the <strong>" . DATABASE . "</strong> database.</p>";
}

// This closes the connection 
mysqli_close($connection);
?>
