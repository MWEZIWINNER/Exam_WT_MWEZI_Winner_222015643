<?php
// Connection details
include('database_connection.php');
// Check if transaction_id is set
if(isset($_REQUEST['transaction_id'])) {
    $transaction_id = $_REQUEST['transaction_id'];
    
    // Retrieve transactions details for the selected transactions
    $stmt = $connection->prepare("SELECT * FROM transactions WHERE transaction_id=?");
    $stmt->bind_param("i", $transaction_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
        $date = $row['date'];
        $amount = $row['amount'];
        $category = $row['category'];
        
    } else {
        echo "transaction not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our transactions</title>
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
    <h1><u>transaction Form</u></h1>
    <form method="post" onsubmit="return confirmUpdate()">
      <label for="transaction_id">Transaction ID:</label>
      <input type="number" id="transaction_id" name="transaction_id" value="<?php echo isset($transaction_id) ? $transaction_id : ''; ?>"><br><br>

      <label for="user_id">user ID:</label>
      <input type="number" id="user_id" name="user_id" value="<?php echo isset($user_id) ? $user_id: ''; ?>" required><br><br>

      <label for="date">date:</label>
      <input type="date" id="date" name="date" value="<?php echo isset($date) ? $date : ''; ?>" required><br><br>

      <label for="amount">amount:</label>
<input type="number" id="amount" name="amount" value="<?php echo isset($amount) ? $amount : ''; ?>" required><br><br>


      <label for="category">CATEGORY:</label>
      <input type="text" id="category" name="category" value="<?php echo isset($category) ? $category : ''; ?>" required><br><br>

      <input type="submit" name="update" value="Update">
    </form>
    <?php
      // Handle update operation
      if(isset($_POST['update'])) {
          // Retrieve updated values from the form
          $user_id = $_POST['user_id'];
          $date = $_POST['date'];
          $amount = $_POST['amount'];
          $category = $_POST['category'];
         
          
          // Update the transactions record in the database
         $stmt = $connection->prepare("UPDATE transactions SET user_id=?, date=?, amount=?, category=? WHERE transaction_id=?");

          $stmt->bind_param("sssii", $user_id, $date, $amount, $category,  $transaction_id);
          if ($stmt->execute()) {
              echo "transaction record updated successfully.";
               // Redirect to transactions.php
              echo '<script>window.location.href = "transactions.php";</script>';
          } else {
              echo "Error updating transaction record: " . $stmt->error;
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
