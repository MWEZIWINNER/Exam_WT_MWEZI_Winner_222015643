<?php
if (isset($_GET['query'])) {
    include('database_connection.php');

    $searchTerm = $connection->real_escape_string($_GET['query']);

    $tables = array(
        'accounts' => array('account_id', 'user_id', 'account_name', 'account_type', 'balance'),
        'budgets' => array('budget_id', 'user_id', 'category_id', 'amount'),
        'categories' => array('category_id', 'user_id', 'category_name'),
        'expenses' => array('expense_id', 'user_id', 'category_id', 'amount', 'date_spent'),
        'goals' => array('goal_id', 'user_id', 'goal_name', 'target_amount', 'current_amount', 'target_date', 'completed', 'created_at'),
        'income' => array('income_id', 'user_id', 'source', 'amount', 'date_received'),
        'reminders' => array('reminder_id', 'user_id', 'reminder_text', 'reminder_date'),
        'reports' => array('report_id', 'user_id', 'report_name', 'start_date', 'end_date', 'report_data'),
        'transactions' => array('transaction_id', 'user_id', 'date', 'amount', 'category')
    );

    echo "<h2><u>Search Results:</u></h2>";

    foreach ($tables as $table => $columns) {
        $sql = "SELECT * FROM $table WHERE ";
        $firstColumn = true;
        foreach ($columns as $column) {
            if (!$firstColumn) {
                $sql .= " OR ";
            }
            $sql .= "$column LIKE '%$searchTerm%'";
            $firstColumn = false;
        }
        $result = $connection->query($sql);

        echo "<h3>$table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>";
                foreach ($row as $key => $value) {
                    echo "$key: $value, ";
                }
                echo "</p>";
            }
        } else {
            // Handle the case when no results are found for a table
            echo "<p>No results found for table: $table</p>";
        }
    }

    $connection->close();
} else {
    // Default table name when query parameter is not set
    $table = 'default_table';
    $sql = "SELECT * FROM $table WHERE ";
    // You can handle this case as per your requirements
    // Maybe you want to display an error message or redirect the user
    // It depends on your application's logic
    echo "<p>Error: No search query provided.</p>";
}
?>
