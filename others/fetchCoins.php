<?php
require('dbconnections/connection.php');

//Fetch volatile coins
            $stmt = $pdo->prepare("SELECT * FROM available_digital_currencies WHERE Active_status = 'TRUE' ORDER BY Token_full_name ASC");
                    
            // Execute the query
            $stmt->execute();

            // Fetch all rows as an associative array
            $this_coins = $stmt->fetchAll(PDO::FETCH_ASSOC);

/*
//Fetch stable coins
            $stmt = $pdo->prepare("SELECT * FROM available_stable_coins ORDER BY Token_full_name ASC");
                                
            // Execute the query
            $stmt->execute();

            // Fetch all rows as an associative array
            $this_stable_coins = $stmt->fetchAll(PDO::FETCH_ASSOC);
*/

?>