<?php
// TODO Kshs rate to be updated periodically;
$kshs_rate = 137; 
//These are inputs from the form
$loan_amount;
$the_coin = "BTCUSDT";
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.binance.com/api/v3/avgPrice?symbol='.$the_coin,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
$result = json_decode($response,true);
echo $result["price"]." ".$the_coin;
            //echo "<span style='color:green' 'display: block';> Username is available.</span>";
?>