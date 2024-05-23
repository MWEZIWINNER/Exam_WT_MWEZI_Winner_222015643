<?php
// Connection details
include('database_connection.php');
// Check if income_id is set
if(isset($_REQUEST['income_id'])) {
    $income_id = $_REQUEST['income_id'];
    
    // Retrieve income details for the selected income
    $stmt = $connection->prepare("SELECT * FROM income WHERE income_id=?");
    $stmt->bind_param("i", $income_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
        $source = $row['source'];
        $amount = $row['amount'];
        $date_received = $row['date_received'];
        
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
  <title>INCOME </title>
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
    <h1><u>INCOME Form</u></h1>
    <form method="post" onsubmit="return confirmUpdate()">
      <label for="income_id">INCOME ID:</label>
      <input type="number" id="income_id" name="income_id" value="<?php echo isset($income_id) ? $income_id : ''; ?>"><br><br>

      <label for="user_id">USER ID:</label>
      <input type="number" id="user_id" name="user_id" value="<?php echo isset($user_id) ? $user_id: ''; ?>" required><br><br>

      <label for="source">source:</label>
      <input type="text" id="source" name="source" value="<?php echo isset($source) ? $source : ''; ?>" required><br><br>

      <label for="amount">amount:</label>
<input type="text" id="amount" name="amount" value="<?php echo isset($amount) ? $amount : ''; ?>" required><br><br>


      <label for="date_received">date received:</label>
      <input type="date" id="date_received" name="date_received" value="<?php echo isset($date_received) ? $date_received : ''; ?>" required><br><br>

      <input type="submit" name="update" value="Update">
    </form>
    <?php
      // Handle update operation
      if(isset($_POST['update'])) {
          // Retrieve updated values from the form
          $user_id = $_POST['user_id'];
          $source = $_POST['source'];
          $amount = $_POST['amount'];
          $date_received = $_POST['date_received'];
         
          
          // Update the income record in the database
         $stmt = $connection->prepare("UPDATE income SET user_id=?, source=?,amount=?,date_received=? WHERE income_id=?");

          $stmt->bind_param("sssii", $user_id, $source, $amount, $date_received,  $income_id);
          if ($stmt->execute()) {
              echo "income record updated successfully.";
               // Redirect to income.php
              echo '<script>window.location.href = "income.php";</script>';
          } else {
              echo "Error updating income record: " . $stmt->error;
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
