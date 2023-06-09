<?php
require('dbconnections/connection.php');

$stmt = $pdo->prepare("SELECT * FROM available_digital_currencies ORDER BY Token_full_name ASC");
        
// Execute the query
$stmt->execute();

// Fetch all rows as an associative array
$this_coins = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>