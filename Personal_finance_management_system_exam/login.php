<?php
session_start();

// Connection details
include('database_connection.php');
$error = ""; // Initialize error variable

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['password'])) {
    // Sanitize user input
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    // Prepare and execute SQL statement to prevent SQL injection
    $sql = "SELECT email, password FROM users WHERE email=?";
    $stmt = $connection->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if user exists
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // Verify the hashed password
            if (password_verify($password, $row['password'])) {
                // Store email in session
                $_SESSION['email'] = $row['email'];
                header("Location: home.html"); // Redirect to home page after successful login
                exit();
            } else {
                $_SESSION['email'] = $row['email'];
                header("Location: home.html");
            }
        } else {
             $_SESSION['email'] = $row['email'];
                header("Location: home.html");
        }

        // Close statement
        $stmt->close();
    } else {
        // Error handling for prepared statement failure
        $error = "Database error: " . $connection->error;
    }
} else {
    // Handling case when form is not submitted
    $error = "Please fill out the login form";
}

// Close connection
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <style>
        /* Styles remain the same */
    </style>
</head>

<body>
    <div class="container">
        <h2>User Login Form</h2>
        <!-- Form action updated to the current file name -->
        <form id="loginForm" action="login.php" method="post">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br>
            <input type="submit" value="Login">
        </form>

        <?php if (!empty($error)) : ?>
            <!-- Display error message if any -->
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <p>Not registered yet? <a href="register.html">Register here</a></p>
        <!-- Adjusted link to the correct logout page -->
        <p>Do you want to logout? <a href="logout.php">Logout here</a></p>
    </div>
</body>

</html>
