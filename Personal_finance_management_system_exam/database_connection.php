<?php
// Connection details
$host = "localhost";
$user ="mwezi";
$pass = "222015643"; 
// Update with your password if applicable
$database = "personal_finance_management_system";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>
