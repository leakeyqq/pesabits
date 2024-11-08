<?php
//Declaring functions

function roundOffsecurity($token_value_in_kshs){
  //check 1 kshs is worth how many coins
  $_1kshs_token = 1/$token_value_in_kshs;
  //See if the number of coins is greater than 1
  if($_1kshs_token>=1 ){
 
        //It works well on numbers greater than 1

        $fraction = $_1kshs_token;
        $fraction = (int) $fraction;
        $fraction += 0.1;

        // Convert the fraction to a string
        $fractionString = (string) $fraction;

        // Find the position of the decimal point
        $decimalPosition = strpos($fractionString, '.');

        // Calculate the distance from the decimal point to the first digit
        $distance = $decimalPosition - 1;

        //echo "The first digit in the fraction is $distance digits away from the decimal point.";
        $rounded_value = (int) $token_value_in_kshs;




        $number = $rounded_value;
        $digitsToSwitch = 0; // Number of digits to switch to zeros

        // Convert the number to a string
        $numberString = (string) $number;

        // Get the length of the string
        $length = strlen($numberString);

        // Replace the last $digitsToSwitch digits with zeros
        $numberString = substr_replace($numberString, str_repeat('0', $digitsToSwitch), $length - $digitsToSwitch, $digitsToSwitch);

        // Convert the string back to a number
        $modifiedNumber = (int) $numberString;

        $rounded_value = $modifiedNumber;
        //echo $modifiedNumber; // Output: 123450000

        return $rounded_value;


  }else{

          $_1kshs_token += 1; 
          //The code below is imported

          $fraction = $_1kshs_token;

          // Convert the fraction to a string
          $fractionString = (string) $fraction;
          
          // Find the position of the decimal point
          $decimalPosition = strpos($fractionString, '.');
          
          // Initialize the count of zeros
          $zerosCount = 0;
          
          // Iterate over the characters following the decimal point
          for ($i = $decimalPosition + 1; $i < strlen($fractionString); $i++) {
              if ($fractionString[$i] === '0') {
                  $zerosCount++;
              } else {
                  break;
              }
          }
          
          //echo "The number of zeros from the decimal point to the first part of the fractional part is $zerosCount.";
          $decimal_places = $zerosCount;
          $rounded_value = round($token_value_in_kshs,$decimal_places);
          return $rounded_value;
  }
  
}



if(!empty($_POST["loan_amount"])){
  // TODO Kshs rate to be updated periodically;
  $kshs_rate = 137; 
  //These are inputs from the form
  $loan_amount = $_POST["loan_amount"];
  $coin_type = $_POST["coin_chosen"];
  $ltv_rate = $_POST["ltv_chosen"];
  $curl = curl_init();

  curl_setopt_array($curl, array 
  (
    CURLOPT_URL => 'https://api.binance.com/api/v3/avgPrice?symbol='.$coin_type,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
  )
);

  $response = curl_exec($curl);

  curl_close($curl);
  $result = json_decode($response,true);
  $token_value = $result["price"]; //Price of 1 token in usd
  $token_value_kshs = $token_value * $kshs_rate; //Price of 1 token in kshs
  $collateral_amount = $loan_amount * (100/$ltv_rate);
  $coins_needed = $collateral_amount / $token_value_kshs;

  $coin_symbol = substr($coin_type, 0, -4);

  //echo $result["price"]." ".$the_coin;
  if(1==1){
      echo "The amount of collateral needed is " . $coins_needed ." ".$coin_symbol;
  }
}
?>