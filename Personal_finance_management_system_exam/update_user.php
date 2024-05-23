<?php
// Connection details
include('database_connection.php');
// Check if user_id is set
if(isset($_REQUEST['user_id'])) {
    $user_id = $_REQUEST['user_id'];
    
    // Retrieve users details for the selected users
    $stmt = $connection->prepare("SELECT * FROM users WHERE user_id=?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row['username'];
        $password = $row['password'];
        $email = $row['email'];
        $full_name = $row['full_name'];
        
    } else {
        echo "user not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our user</title>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <style>
    /* Styles for header, section, footer */
    /* CSS styles */

    /* Include the CSS styles you provided */
  </style>
</head>
<body bgcolor="brown">
  <header>
    <!-- Header content -->
  </header>
  <section>
    <h1><u>user Form</u></h1>
    <form method="post" onsubmit="return confirmUpdate()">
      <label for="user_id">USER ID:</label>
      <input type="number" id="user_id" name="user_id" value="<?php echo isset($user_id) ? $user_id : ''; ?>"><br><br>

      <label for="username">user Name:</label>
      <input type="text" id="username" name="username" value="<?php echo isset($username) ? $username: ''; ?>" required><br><br>

      <label for="password">password:</label>
      <input type="text" id="password" name="password" value="<?php echo isset($password) ? $password : ''; ?>" required><br><br>

      <label for="email">email:</label>
<input type="email" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" required><br><br>


      <label for="full_name">Names:</label>
      <input type="text" id="full_name" name="full_name" value="<?php echo isset($full_name) ? $full_name : ''; ?>" required><br><br>

      <input type="submit" name="update" value="Update">
    </form>
    <?php
      // Handle update operation
      if(isset($_POST['update'])) {
          // Retrieve updated values from the form
          $username = $_POST['username'];
          $password = $_POST['password'];
          $email = $_POST['email'];
          $full_name = $_POST['full_name'];
         
          
          // Update the users record in the database
         $stmt = $connection->prepare("UPDATE users SET username=?, password=?, email=?, full_name=? WHERE user_id=?");

          $stmt->bind_param("sssii", $username, $password, $email, $full_name,  $user_id);
          if ($stmt->execute()) {
              echo "user record updated successfully.";
               // Redirect to users.php
              echo '<script>window.location.href = "user.php";</script>';
          } else {
              echo "Error updating user record: " . $stmt->error;
          }
          $stmt->close();
      }
    ?>
   
  </section>
  <footer>
    <!-- Footer content -->
  </footer>
  <script>
    function confirmUpdate() {
      return confirm("Are you sure you want to update this record?");
    }
  </script>
</body>
</html>
