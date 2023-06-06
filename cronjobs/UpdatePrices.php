<?php

date_default_timezone_set('Africa/Nairobi');

class UpdatePrices{
    public $digital_currencies = array();

    //This function fetches all the available digital currencies from the db
    public function __construct(){
        require '../forms/dbconnections/connection.php';

        $array = array(); // Initialize an empty array

            // Execute the SELECT quuery
            $query = "SELECT Token_short_name FROM available_digital_currencies";
            $stmt = $pdo->query($query);

            // Fetch all items in the column
            $columnData = $stmt->fetchAll(PDO::FETCH_COLUMN);

            // Output the fetched items
            foreach ($columnData as $item) {
                $item = '"'.$item.'"';
                array_push($array, $item);
            }
            $string = implode(',', $array);

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.binance.com/api/v3/ticker/price?symbols=['.$string.']',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
      

            $data = json_decode($response, true);

            foreach ($data as $item) {
                $symbol = $item['symbol'];
                $price = $item['price'];

               echo "Symbol: $symbol\n";
               echo "Price: $price\n\n";
                
            // Prepare the UPDATE statement
            $query = "UPDATE available_digital_currencies SET USD_Price=:usdPrice, Last_updated_date=:currentDate, Last_updated_time=:currentTime WHERE Token_short_name=:tokenInitials";
            $stmt = $pdo->prepare($query);

            // Bind the parameter values
            $stmt->bindParam(':usdPrice', $price);
            $stmt->bindParam(':tokenInitials', $symbol);
            $current_date =  date('Y-m-d');
            $current_time =  date('H:i:s');
            $stmt->bindParam(':currentDate', $current_date);
            $stmt->bindParam(':currentTime', $current_time);

            // Execute the statement
            if ($stmt->execute()) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $stmt->errorInfo()[2];
            }
            }
    }
    
}
//cool
$obj = new UpdatePrices();
$pdo = null;
?>




