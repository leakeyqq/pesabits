<?php
require '../forms/dbconnections/connection.php';


// Prepare the query
$query = "SELECT Kshs FROM exchange_rate";

// Prepare the statement
$statement = $pdo->prepare($query);


// Execute the statement
$statement->execute();

// Fetch the result
$dataItem = $statement->fetchColumn();

// Output the result
echo $dataItem;

?>