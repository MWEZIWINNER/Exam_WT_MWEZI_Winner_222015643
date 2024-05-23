<?php
// Connection details
include('database_connection.php');
// Check if budget_id is set
if(isset($_REQUEST['budget_id'])) {
    $budget_id = $_REQUEST['budget_id'];
    
    // Retrieve budgets details for the selected budgets
    $stmt = $connection->prepare("SELECT * FROM budgets WHERE budget_id=?");
    $stmt->bind_param("i", $budget_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
        $category_id = $row['category_id'];
        $amount = $row['amount'];
        
        
    } else {
        echo "budget not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Budget </title>
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
    <h1><u>Budget  Form</u></h1>
    <form method="post" onsubmit="return confirmUpdate()">
      <label for="budget_id">Budget Id:</label>
      <input type="number" id="budget_id" name="budget_id" value="<?php echo isset($budget_id) ? $budget_id : ''; ?>"><br><br>

      <label for="user_id">USER ID:</label>
      <input type="text" id="user_id" name="user_id" value="<?php echo isset($user_id) ? $user_id: ''; ?>" required><br><br>

      <label for="category_id">Category Id:</label>
      <input type="number" id="category_id" name="category_id" value="<?php echo isset($category_id) ? $category_id : ''; ?>" required><br><br>

      <label for="amount">amount:</label>
      <input type="number" id="amount" name="amount" value="<?php echo isset($amount) ? $amount : ''; ?>" required><br><br>

      <input type="submit" name="update" value="Update">
    </form>
    <?php
      // Handle update operation
      if(isset($_POST['update'])) {
          // Retrieve updated values from the form
          $user_id = $_POST['user_id'];
          $category_id = $_POST['category_id'];
          $amount = $_POST['amount'];
          
          // Update the budgets record in the database
          $stmt = $connection->prepare("UPDATE budgets SET user_id=?, category_id=?, amount=? WHERE budget_id=?");
          $stmt->bind_param("iisi", $user_id, $category_id, $amount, $budget_id);
          if ($stmt->execute()) {
              echo "budget record updated successfully.";
              // Redirect to budgets.php
              echo '<script>window.location.href = "budgets.php";</script>';
          } else {
              echo "Error updating budget record: " . $stmt->error;
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
