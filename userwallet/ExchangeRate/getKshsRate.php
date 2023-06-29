<?php

// Prepare the query
function getShsRate(){
require '../forms/dbconnections/connection.php';
$query = "SELECT Kshs FROM exchange_rate";

// Prepare the statement
$statement = $pdo->prepare($query);


// Execute the statement
$statement->execute();

// Fetch the result
$dataItem = $statement->fetchColumn();

// Output the result
return $dataItem;
}

?>