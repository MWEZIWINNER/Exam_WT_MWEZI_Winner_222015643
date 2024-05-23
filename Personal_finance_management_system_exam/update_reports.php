<?php
// Connection details
include('database_connection.php');
// Check if report_id is set
if(isset($_REQUEST['report_id'])) {
    $report_id = $_REQUEST['report_id'];
    
    // Retrieve reports details for the selected reports
    $stmt = $connection->prepare("SELECT * FROM reports WHERE report_id=?");
    $stmt->bind_param("i", $report_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
        $report_name = $row['report_name'];
        $start_date = $row['start_date'];
        $end_date = $row['end_date'];
         $report_data = $row['report_data'];
        
    } else {
        echo "report not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>REPORT </title>
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
    <h1><u>REPORT  Form</u></h1>
    <form method="post" onsubmit="return confirmUpdate()">
      <label for="report_id">REPORT ID:</label>
      <input type="number" id="report_id" name="report_id" value="<?php echo isset($report_id) ? $report_id : ''; ?>"><br><br>

      <label for="user_id">USER ID:</label>
      <input type="number" id="user_id" name="user_id" value="<?php echo isset($user_id) ? $user_id: ''; ?>" required><br><br>

      <label for="report_name">report name:</label>
      <input type="text" id="report_name" name="report_name" value="<?php echo isset($report_name) ? $report_name : ''; ?>" required><br><br>

      <label for="start_date">start date:</label>
<input type="DATE" id="start_date" name="start_date" value="<?php echo isset($start_date) ? $start_date : ''; ?>" required><br><br>


      <label for="end_date">end date:</label>
      <input type="DATE" id="end_date" name="end_date" value="<?php echo isset($end_date) ? $end_date : ''; ?>" required><br><br>

       <label for="report_data">report data:</label>
      <input type="TEXT" id="report_data" name="report_data" value="<?php echo isset($report_data) ? $report_data : ''; ?>" required><br><br>

      <input type="submit" name="update" value="Update">
    </form>
    <?php
      // Handle update operation
      if(isset($_POST['update'])) {
          // Retrieve updated values from the form
          $user_id = $_POST['user_id'];
          $report_name = $_POST['report_name'];
          $start_date = $_POST['start_date'];
          $end_date = $_POST['end_date'];
           $report_data = $_POST['report_data'];
         
          
          // Update the reports record in the database
         $stmt = $connection->prepare("UPDATE reports SET user_id=?, report_name=?,start_date=?, end_date=?, report_data=? WHERE report_id=?");

          $stmt->bind_param("sssiii", $user_id, $report_name, $start_date, $end_date,$report_data,  $report_id);
          if ($stmt->execute()) {
              echo "report record updated successfully.";
               // Redirect to reports.php
              echo '<script>window.location.href = "reports.php";</script>';
          } else {
              echo "Error updating report record: " . $stmt->error;
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
