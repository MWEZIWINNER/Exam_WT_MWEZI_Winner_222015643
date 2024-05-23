<?php
// Connection details
include('database_connection.php');
// Check if user_id is set
if(isset($_REQUEST['user_id'])) {
    $user_id = $_REQUEST['user_id'];
    
    // JavaScript confirmation for deletion
    echo '<script>
            function confirmdelete() {
              return confirm("Are you sure you want to delete this record?");
            }
          </script>';
    
    // Prepare and execute the DELETE statement after confirmation
    if (isset($_POST['confirm_delete']) && $_POST['confirm_delete'] == 'yes') {
        $stmt = $connection->prepare("DELETE FROM users WHERE user_id=?");
        $stmt->bind_param("i", $user_id); // corrected variable name
        if ($stmt->execute()) {
            echo "Record deleted successfully.";
            // Redirect to user.php
            echo '<script>window.location.href = "user.php";</script>';
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
    echo "user_id is not set.";
}

$connection->close();
?>