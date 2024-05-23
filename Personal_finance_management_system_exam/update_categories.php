<?php
// Connection details
include('database_connection.php');
// Check if category_id is set
if(isset($_REQUEST['category_id'])) {
    $category_id = $_REQUEST['category_id'];
    
    // Retrieve categories details for the selected categories
    $stmt = $connection->prepare("SELECT * FROM categories WHERE category_id=?");
    $stmt->bind_param("s", $category_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
        $category_name = $row['category_name'];
        
        
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
  <title>CATEGORY </title>
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
    <h1><u>CATEGORY FORM</u></h1>
    <form method="post" onsubmit="return confirmUpdate()">
      <label for="category_id">CATEGORY ID:</label>
      <input type="number" id="category_id" name="category_id" value="<?php echo isset($category_id) ? $category_id : ''; ?>"><br><br>

      <label for="user_id">USER ID:</label>
      <input type="number" id="user_id" name="user_id" value="<?php echo isset($user_id) ? $user_id: ''; ?>" required><br><br>

      <label for="category_name">category name:</label>
      <input type="text" id="category_name" name="category_name" value="<?php echo isset($category_name) ? $category_name : ''; ?>" required><br><br>

     

      <input type="submit" name="update" value="Update">
    </form>
    <?php
      // Handle update operation
      if(isset($_POST['update'])) {
          // Retrieve updated values from the form
          $user_id = $_POST['user_id'];
          $category_name = $_POST['category_name'];
          
         
          
          // Update the categories record in the database
         $stmt = $connection->prepare("UPDATE categories SET user_id=?, category_name=? WHERE category_id=?");

          $stmt->bind_param("sss", $user_id, $category_name,   $category_id);
          if ($stmt->execute()) {
              echo "categories record updated successfully.";
               // Redirect to categories.php
              echo '<script>window.location.href = "categories.php";</script>';
          } else {
              echo "Error updating categories record: " . $stmt->error;
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
