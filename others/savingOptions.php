<?php
include 'dbconnections/connection.php';

    // Prepare the SQL statement to fetch data
    try{
        $stmt = $pdo->prepare("SELECT * FROM savings_options WHERE Active_status='TRUE' ORDER BY Period_months DESC");
        
        // Execute the query
        $stmt->execute();
        
        // Fetch all rows as an associative array
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    //AJAX CALL BELOW
    if(!empty($_POST["savings_amount"])){
        $savings_amount = $_POST["savings_amount"];
        $savings_duration =  $_POST["savings_duration"];

     //Fetch savings APY
          $sql_check = "SELECT APY FROM savings_options WHERE Period_months = ?  LIMIT 1";
          $stmt = $pdo -> prepare($sql_check);
          $stmt -> execute(array($savings_duration));
          $exists = $stmt -> fetch();
          $savings_apy = $exists['APY'];
          $interest_earned = $savings_apy/100 * $savings_duration/12 * $savings_amount;
          $amount_back = $interest_earned + $savings_amount;
          echo "Interest Kshs ".number_format($interest_earned,0)." and the total payout Kshs ".number_format($amount_back,0);


    }

?>