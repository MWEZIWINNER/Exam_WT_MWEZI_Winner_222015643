<?php
// Connection details
include('database_connection.php');
// Check if category_id is set
if(isset($_REQUEST['category_id'])) {
    $category_id = $_REQUEST['category_id'];
    
    // JavaScript confirmation for deletion
    echo '<script>
            function confirmdelete() {
              return confirm("Are you sure you want to delete this record?");
            }
          </script>';
    
    // Prepare and execute the DELETE statement after confirmation
    if (isset($_POST['confirm_delete']) && $_POST['confirm_delete'] == 'yes') {
        $stmt = $connection->prepare("DELETE FROM categories WHERE category_id=?");
        $stmt->bind_param("i", $category_id); // corrected variable name
        if ($stmt->execute()) {
            echo "Record deleted successfully.";
            // Redirect to categories.php
            echo '<script>window.location.href = "categories.php";</script>';
        } else {
            echo "Error deleting data: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Display confirmation dialog
        echo '<form method="post" onsubmit="return confirmdelete()">
                <input type="hidden" name="confirm_delete" value="yes">
                <input type="submit" value="Delete Record">
              </form>';
    }
} else {
    echo "category_id is not set.";
}

$connection->close();
?>