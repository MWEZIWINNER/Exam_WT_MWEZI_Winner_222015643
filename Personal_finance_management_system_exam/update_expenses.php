<?php
// Connection details
include('database_connection.php');
// Check if expense_id is set
if(isset($_REQUEST['expense_id'])) {
    $expense_id = $_REQUEST['expense_id'];
    
    // Retrieve expenses details for the selected expenses
    $stmt = $connection->prepare("SELECT * FROM expenses WHERE expense_id=?");
    $stmt->bind_param("i", $expense_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
        $category_id = $row['category_id'];
        $amount = $row['amount'];
        $date_spent = $row['date_spent'];
        
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
  <title>EXPENSE </title>
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
    <h1><u>EXPENSE Form</u></h1>
    <form method="post" onsubmit="return confirmUpdate()">
      <label for="expense_id">EXPENSE ID:</label>
      <input type="number" id="expense_id" name="expense_id" value="<?php echo isset($expense_id) ? $expense_id : ''; ?>"><br><br>

      <label for="user_id">USER ID:</label>
      <input type="number" id="user_id" name="user_id" value="<?php echo isset($user_id) ? $user_id: ''; ?>" required><br><br>

      <label for="category_id">category_id:</label>
      <input type="text" id="category_id" name="category_id" value="<?php echo isset($category_id) ? $category_id : ''; ?>" required><br><br>

      <label for="amount">amount:</label>
<input type="text" id="amount" name="amount" value="<?php echo isset($amount) ? $amount : ''; ?>" required><br><br>


      <label for="date_spent">DATE SPENT:</label>
      <input type="date" id="date_spent" name="date_spent" value="<?php echo isset($date_spent) ? $date_spent : ''; ?>" required><br><br>

      <input type="submit" name="update" value="Update">
    </form>
    <?php
      // Handle update operation
      if(isset($_POST['update'])) {
          // Retrieve updated values from the form
          $user_id = $_POST['user_id'];
          $category_id = $_POST['category_id'];
          $amount = $_POST['amount'];
          $date_spent = $_POST['date_spent'];
         
          
          // Update the expenses record in the database
         $stmt = $connection->prepare("UPDATE expenses SET user_id=?, category_id=?, amount=?, date_spent=? WHERE expense_id=?");

          $stmt->bind_param("sssii", $user_id, $category_id, $amount, $date_spent,  $expense_id);
          if ($stmt->execute()) {
              echo "expense record updated successfully.";
               // Redirect to expenses.php
              echo '<script>window.location.href = "expenses.php";</script>';
          } else {
              echo "Error updating expense record: " . $stmt->error;
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
