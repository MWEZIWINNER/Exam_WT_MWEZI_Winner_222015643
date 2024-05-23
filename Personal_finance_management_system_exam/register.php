<?php
include('database_connection.php');

// Handling POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    
    // Preparing SQL query
    $sql = "INSERT INTO users ( username, password, email, full_name) VALUES ( '$username', '$password', '$email', '$full_name')";

    // Executing SQL query
    if ($connection->query($sql) === TRUE) {
        // Redirecting to login page on successful registration
        header("Location: login.php");
        exit();
    } else {
        // Displaying error message if query execution fails
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

// Closing database connection
$connection->close();
?>
