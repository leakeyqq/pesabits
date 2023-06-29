<?php
require ('dbconnections/connection.php');

//Check LTV of non stable coins
            $stmt = $pdo->prepare("SELECT * FROM set_loan_ltv where stability='non-stable' LIMIT 1");
                    
            // Execute the query
            $stmt->execute();

            // Fetch all rows as an associative array
            $this_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            

//Check LTV of stable coins
            $stmt = $pdo->prepare("SELECT * FROM set_loan_ltv where stability='stable' LIMIT 1");
                                
            // Execute the query
            $stmt->execute();

            // Fetch all rows as an associative array
            $this_stableCoins_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>