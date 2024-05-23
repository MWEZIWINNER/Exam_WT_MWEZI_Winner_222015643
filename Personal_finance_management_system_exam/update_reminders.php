<?php
// Connection details
include('database_connection.php');
// Check if reminder_id is set
if(isset($_REQUEST['reminder_id'])) {
    $reminder_id = $_REQUEST['reminder_id'];
    
    // Retrieve reminders details for the selected reminders
    $stmt = $connection->prepare("SELECT * FROM reminders WHERE reminder_id=?");
    $stmt->bind_param("i", $reminder_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
        $reminder_text = $row['reminder_text'];
        $reminder_date = $row['reminder_date'];
        
        
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
  <title>REMINDER </title>
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
    <h1><u>REMINDER Form</u></h1>
    <form method="post" onsubmit="return confirmUpdate()">
      <label for="reminder_id">REMINDER ID:</label>
      <input type="number" id="reminder_id" name="reminder_id" value="<?php echo isset($reminder_id) ? $reminder_id : ''; ?>"><br><br>

      <label for="user_id">USER ID:</label>
      <input type="number" id="user_id" name="user_id" value="<?php echo isset($user_id) ? $user_id: ''; ?>" required><br><br>

      <label for="reminder_text">reminder text:</label>
      <input type="text" id="reminder_text" name="reminder_text" value="<?php echo isset($reminder_text) ? $reminder_text : ''; ?>" required><br><br>

      <label for="reminder_date">reminder_date:</label>
<input type="date" id="reminder_date" name="reminder_date" value="<?php echo isset($reminder_date) ? $reminder_date : ''; ?>" required><br><br>

      <input type="submit" name="update" value="Update">
    </form>
    <?php
      // Handle update operation
      if(isset($_POST['update'])) {
          // Retrieve updated values from the form
          $user_id = $_POST['user_id'];
          $reminder_text = $_POST['reminder_text'];
          $reminder_date = $_POST['reminder_date'];
          
          
          // Update the reminders record in the database
         $stmt = $connection->prepare("UPDATE reminders SET user_id=?, reminder_text=?,reminder_date=? WHERE reminder_id=?");

          $stmt->bind_param("sssii", $user_id, $reminder_text, $reminder_date,  $reminder_id);
          if ($stmt->execute()) {
              echo "reminder record updated successfully.";
               // Redirect to reminders.php
              echo '<script>window.location.href = "reminders.php";</script>';
          } else {
              echo "Error updating reminder record: " . $stmt->error;
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
