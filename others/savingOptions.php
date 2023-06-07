<?php
//include 'forms/dbconnections/connection.php';
$host = '127.0.0.1';
$db   = 'pesabits';
$user = 'root';
$pass = '';
$port = "3307";
$charset = 'utf8mb4';

$options = [
    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    \PDO::ATTR_EMULATE_PREPARES   => false,
];
$dsn = "mysql:host=$host;dbname=$db;charset=$charset;port=$port";
try {
     $pdo = new \PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}


    // Prepare the SQL statement to fetch data
    try{
        $stmt = $pdo->prepare("SELECT * FROM savings_options WHERE Active_status='TRUE'");
        
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
          echo "You will earn an interest of Kshs ".number_format($interest_earned,0)." and the total amount to receive back will be Kshs ".number_format($amount_back,0);


    }

?>