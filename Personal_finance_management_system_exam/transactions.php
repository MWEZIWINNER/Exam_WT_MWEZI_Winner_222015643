<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Transaction</title>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <style>
   /* Normal link */ a {
      padding: 10px;
      color: white;
      background-color: beige;
      text-decoration: none;
      margin-right: 15px;
    }
    /* Visited link */
    a:visited {
      color: purple;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }
    /* Active link */
    a:active {
      background-color: red;
    }
    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 15px; /* Adjust this value as needed */
      padding: 8px;
    }
    section {
      padding: 71px;
      border-bottom: 1px solid #ddd;
    }
    footer {
      text-align: center;
      padding: 15px;
      background-color: beige;
    }
   
   .dropdown {
    position: relative;
    display: inline;
    margin-right:10px;
   }
   .dropdown-contents {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0,2);
    left:0;
   }
   .dropdown:hover .dropdown-contents{
    display: block;
   }
   .dropdown-contents a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;

   }
   .dropdown-contents a: hover{
    background-color: #f1f1f1;
   }
   section{
    padding: 80px;
    border-bottom: 1px solid #ddd;
   }
   footer{
    text-align: center;
    padding: 15px;
    background-color: white;
   }
  /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 15px; /* Adjust this value as needed */
      padding: 8px;
    }
    section {
      padding: 71px;
      border-bottom: 1px solid #ddd;
    }
    footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  text-align: center;
  padding: 20px;
  background-color: beige;
}
    .button{
      border:5px solid;
      background-color: pink;
    }
  </style>
</head>
<body bgcolor="olive">
  
  <header>
    <body style="background-image: url('./image/trans.jpeg'); background-size: cover; background-repeat: no-repeat;">
    <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
    <ul style="list-style-type: none; padding: 0;">
     <li style="display: inline; margin-right: 10px;"><img src="./image/logo.jpeg" width="90" height="60" alt="Logo"></li>
      <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./account.php">ACCOUNT</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./user.php">USER</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./transactions.php">TRANSACTION</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./budgets.php">BUDGETS</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./expenses.php">EXPENSES</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./goals.php">GOALS</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./categories.php">CATEGORY</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./reports.php">REPORT</a></li>
       <li style="display: inline; margin-right: 10px;"><a href="./reminders.php">REMINDER</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./income.php">INCOME</a></li>
       
       
       <li class="dropdown" style="display: inline; margin-right: 10px;">
    <a href="#" class="dropdown-toggle" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
    <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
    </div>
</li>
    </ul>
  </header>
  

  <section>
    <h1><u>Transactions Form</u></h1>
    <form method="post" onsubmit="return confirmInsert();">
      <label for="transaction_id">Transaction ID:</label>
      <input type="number" id="transaction_id" name="transaction_id"><br><br>
      <label for="user_id">USER ID:</label>
      <input type="number" id="user_id" name="user_id" required><br><br>
      <label for="date">date:</label>
      <input type="date" id="date" name="date" required><br><br>
      <label for="amount">Amount:</label>
      <input type="number" id="amount" name="amount" required><br><br>
      <label for="category">CATEGORY:</label>
      <input type="text" id="category" name="category" required><br><br>

      <input type="submit" name="add" value="Insert"><br><br>
      <a class="button" href='home.html'>back to home</a>
      <?php
  include('database_connection.php');

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $transaction_id = $_POST['transaction_id'];
      $user_id = $_POST['user_id'];
      $date = $_POST['date'];
      $amount = $_POST['amount'];
      $category = $_POST['category'];

      $stmt = $connection->prepare("INSERT INTO transactions (transaction_id, user_id,date, amount, category) VALUES (?, ?, ?, ?, ?)");
      if ($stmt === false) {
          die("Error preparing statement: " . $connection->error);
      }

      $stmt->bind_param("iisds", $transaction_id, $user_id, $date, $amount, $category);

      if ($stmt->execute() == TRUE) {
          echo "New record has been added successfully";
      } else {
          echo "Error: " . $stmt->error;
      }
      $stmt->close();
  }
  ?>
    </form><br><br>
    
    <h2>Table of Transactions</h2>
    <table border="5">
      <tr>
        <th>Transaction ID</th>
        <th>USER ID</th>
        <th>date</th>
        <th>Amount</th>
        <th>CATEGORY</th>
        <th>Delete</th>
        <th>Update</th>
      </tr>
      <?php
      include('database_connection.php');
      $sql = "SELECT * FROM transactions"; 
      $result = $connection->query($sql);
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $transaction_id = $row['transaction_id'];
              echo "<tr>
              <td>" . $row['transaction_id'] . "</td>
              <td>" . $row['user_id'] . "</td>
              <td>" . $row['date'] . "</td>
              <td>" . $row['amount'] . "</td>
              <td>" . $row['category'] . "</td>
              <td><a style='padding:4px' href='delete_transactions.php?transaction_id=$transaction_id'>Delete</a></td> 
              <td><a style='padding:4px' href='update_transactions.php?transaction_id=$transaction_id'>Update</a></td> 
              </tr>";
          }
      } else {
          echo "<tr><td colspan='7'>No data found</td></tr>";
      }
      $connection->close();
      ?>
    </table>
  </section>

  <footer>
    <div style="text-align: center;"><b><h2>UR CBE BIT &copy; 2024 &reg; Designed by: @winnermwezi</h2></b></div>
  </footer>
  <script>
    function confirmInsert() {
      return confirm("Are you sure you want to insert this record?");
    }
  </script>
</body>
</html>
