<?php

$array = array('"BTCUSDT"', '"BNBUSDT"');
$string = implode(',', $array);

//echo $string;

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
//echo $response;

$data = json_decode($response, true);

foreach ($data as $item) {
    $symbol = $item['symbol'];
    $price = $item['price'];

    echo "Symbol: $symbol\n";
    echo "Price: $price\n\n";
}
?>