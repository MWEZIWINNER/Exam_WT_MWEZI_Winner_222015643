<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>INCOME</title>
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
   footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  text-align: center;
  padding: 20px;
  background-color: beige;
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
    .button{
      border:5px solid;
      background-color: pink;
    }
  </style>
</head>
<body bgcolor="olive">
  <header>
    <body style="background-image: url('./image/income.jpeg'); background-size: cover; background-repeat: no-repeat;">
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
    <h1><u>Income Form</u></h1>
    <form method="post" onsubmit="return confirmInsert();">
      <label for="income_id">INCOME ID:</label>
      <input type="number" id="income_id" name="income_id"><br><br>

      <label for="user_id">USER ID:</label>
      <input type="number" id="user_id" name="user_id" required><br><br>

       <label for="source">SOURCE:</label>
      <input type="TEXT" id="source" name="source" required><br><br>

     <label for="amount">AMOUNT:</label>
      <input type="number" id="amount" name="amount" required><br><br>

     <label for="date_received">DATE:</label>
      <input type="date" id="date_received" name="date_received" required><br><br>

      <input type="submit" name="add" value="Insert" onclick="return confirmInsert()"><br><br>
      <a class="button" href='home.html'>back to home</a>


    </form><br><br>
    
      
    <?php
     include('database_connection.php');
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $stmt = $connection->prepare("INSERT INTO income (income_id, user_id,source, amount,date_received) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiii", $income_id, $user_id, $source, $amount,$date_received);
        $income_id = $_POST['income_id'];
        $user_id = $_POST['user_id'];
        $source = $_POST['source'];
        $amount = $_POST['amount'];
        $date_received = $_POST['date_received'];
        if ($stmt->execute() == TRUE) {
          echo "New record has been added successfully";
        } else {
          echo "Error: " . $stmt->error;
        }
        $stmt->close();
      }
      $connection->close();
    ?>
    <h2>Table of income</h2>
    <table border="5">
      <tr>
        <th>INCOME ID</th>
        <th>USER ID</th>
        <th>SOURCE</th>
        <th>AMOUNT</th>
        <th>DATE RECIEVED</th>
        <th>Delete</th>
        <th>Update</th>
      </tr>
      <?php
       include('database_connection.php');
        $sql = "SELECT * FROM income"; 
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $income_id = $row['income_id'];
            echo "<tr>
              <td>" . $row['income_id'] . "</td>
              <td>" . $row['user_id'] . "</td>
              <td>" . $row['source'] . "</td>
              <td>" . $row['amount'] . "</td>
              <td>" . $row['date_received'] . "</td>
              <td><a style='padding:4px' href='delete_income.php?income_id=$income_id'>Delete</a></td> 
              <td><a style='padding:4px' href='update_income.php?income_id=$income_id'>Update</a></td> 
            </tr>";
          }
        } else {
          echo "<tr><td colspan='6'>No data found</td></tr>";
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
