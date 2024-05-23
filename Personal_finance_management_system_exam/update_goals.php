<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>goal</title>
  <style>
    /* Your CSS styles here */
  </style>
</head>
<body bgcolor="brown">
  <header>
    <!-- Header content -->
  </header>
  <section>
    <h1><u>Goal Form</u></h1>
    <?php
    include('database_connection.php');
    if(isset($_REQUEST['goal_id'])) {
        $goal_id = $_REQUEST['goal_id'];
        $stmt = $connection->prepare("SELECT * FROM goals WHERE goal_id=?");
        $stmt->bind_param("i", $goal_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row['user_id'];
            $goal_name = $row['goal_name'];
            $target_amount = $row['target_amount'];
            $current_amount = $row['current_amount'];
            $target_date = $row['target_date'];
        } else {
            echo "Goal not found.";
        }
    }
    ?>
    <form method="post" onsubmit="return confirmUpdate()">
      <label for="user_id">User ID:</label>
      <input type="text" id="user_id" name="user_id" value="<?php echo isset($user_id) ? $user_id : ''; ?>" required><br><br>

      <label for="goal_name">Goal Name:</label>
      <input type="text" id="goal_name" name="goal_name" value="<?php echo isset($goal_name) ? $goal_name : ''; ?>" required><br><br>

      <label for="target_amount">Target Amount:</label>
      <input type="text" id="target_amount" name="target_amount" value="<?php echo isset($target_amount) ? $target_amount : ''; ?>" required><br><br>

      <label for="current_amount">Current Amount:</label>
      <input type="text" id="current_amount" name="current_amount" value="<?php echo isset($current_amount) ? $current_amount : ''; ?>" required><br><br>

      <label for="target_date">Target Date:</label>
      <input type="text" id="target_date" name="target_date" value="<?php echo isset($target_date) ? $target_date : ''; ?>" required><br><br>

      <input type="submit" name="update" value="Update">
    </form>
    <?php
    if(isset($_POST['update'])) {
        $user_id = $_POST['user_id'];
        $goal_name = $_POST['goal_name'];
        $target_amount = $_POST['target_amount'];
        $current_amount = $_POST['current_amount'];
        $target_date = $_POST['target_date'];
        
        $stmt = $connection->prepare("UPDATE goals SET user_id=?, goal_name=?, target_amount=?, current_amount=?, target_date=? WHERE goal_id=?");
        $stmt->bind_param("issssi", $user_id, $goal_name, $target_amount, $current_amount, $target_date, $goal_id);
        if ($stmt->execute()) {
            echo "Goal record updated successfully.";
            echo '<script>window.location.href = "goals.php";</script>';
        } else {
            echo "Error updating goal record: " . $stmt->error;
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
