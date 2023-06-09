<?php
require ('dbconnections/connection.php');

$stmt = $pdo->prepare("SELECT * FROM set_loan_ltv");
        
// Execute the query
$stmt->execute();

// Fetch all rows as an associative array
$this_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
//print_r ($rows);



?>