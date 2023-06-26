<?php
require ('dbconnections/connection.php');

//Check LTV of non stable coins
            $stmt = $pdo->prepare("SELECT * FROM set_loan_ltv");
                    
            // Execute the query
            $stmt->execute();

            // Fetch all rows as an associative array
            $this_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            

//Check LTV of stable coins
            $stmt = $pdo->prepare("SELECT * FROM set_loan_ltv_stableCoins");
                                
            // Execute the query
            $stmt->execute();

            // Fetch all rows as an associative array
            $this_stableCoins_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>