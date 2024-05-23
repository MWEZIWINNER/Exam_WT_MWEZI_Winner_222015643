<?php
// Connection details
include('database_connection.php');
// Check if account_id is set
if(isset($_REQUEST['account_id'])) {
    $account_id = $_REQUEST['account_id'];
    
    // Retrieve account details for the selected account
    $stmt = $connection->prepare("SELECT * FROM account WHERE account_id=?");
    $stmt->bind_param("i", $account_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $account_name = $row['account_name'];
        $account_type = $row['account_type'];
        $balance = $row['balance'];
        $user_id = $row['user_id'];
        
    } else {
        echo "account not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ACCOUNT </title>
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
    <h1><u>ACCOUNT  Form</u></h1>
    <form method="post" onsubmit="return confirmUpdate()">
      <label for="account_id">ACCOUNT ID:</label>
      <input type="number" id="account_id" name="account_id" value="<?php echo isset($account_id) ? $account_id : ''; ?>"><br><br>

      <label for="account_name">account name:</label>
      <input type="text" id="account_name" name="account_name" value="<?php echo isset($account_name) ? $account_name: ''; ?>" required><br><br>

      <label for="account_type">account type:</label>
      <input type="text" id="account_type" name="account_type" value="<?php echo isset($account_type) ? $account_type : ''; ?>" required><br><br>

      <label for="balance">balance:</label>
<input type="balance" id="balance" name="balance" value="<?php echo isset($balance) ? $balance : ''; ?>" required><br><br>


      <label for="user_id">USER ID:</label>
      <input type="number" id="user_id" name="user_id" value="<?php echo isset($user_id) ? $user_id : ''; ?>" required><br><br>

      <input type="submit" name="update" value="Update">
    </form>
    <?php
      // Handle update operation
      if(isset($_POST['update'])) {
          // Retrieve updated values from the form
          $account_name = $_POST['account_name'];
          $account_type = $_POST['account_type'];
          $balance = $_POST['balance'];
          $user_id = $_POST['user_id'];
         
          
          // Update the account record in the database
         $stmt = $connection->prepare("UPDATE account SET account_name=?,account_type=?, balance=?, user_id=? WHERE account_id=?");

          $stmt->bind_param("sssii", $account_name, $account_type, $balance, $user_id,  $account_id);
          if ($stmt->execute()) {
              echo "account record updated successfully.";
               // Redirect to account.php
              echo '<script>window.location.href = "account.php";</script>';
          } else {
              echo "Error updating account record: " . $stmt->error;
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
