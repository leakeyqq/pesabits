<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/userwallet.css">
    <link rel="stylesheet" href="../css/nav_style.css">
    <title>Balance</title>
</head>
<body>
    <?php
    include '../header.php';
    ?>
    <br>
<?php include 'wallet_nav.php';
?>
<table>
        <tr>
            <th colspan="3">Coin balances</th>
        </tr>
        <tr>
            <td rowspan="2">BTC</td>
            <td>Available<br> 0.0043334</td>
            <td>Kshs 3,500</td>
        </tr>
        <tr>
            <td>Locked<br>0.000030</td>
            <td>Kshs 240</td>
        </tr>
        
        <tr>
            <td rowspan="2">ETH</td>
            <td>Available<br>5.67000</td>
            <td>Kshs 78,393</td>
        </tr>
        <tr>
            <td>Locked<br> 0.0000</td>
            <td>Kshs 0</td>
        </tr>
        <tr>
            <td rowspan="2">BNB</td>
            <td>Available<br>0.00000</td>
            <td>Kshs 0</td>
        </tr>
        <tr>
            <td>Locked<br> 0.0000</td>
            <td>Kshs 0</td>
        </tr>
        <tr>
            <td rowspan="2">LTC</td>
            <td>Available<br>0.00000</td>
            <td>Kshs 0</td>
        </tr>
        <tr>
            <td>Locked<br> 0.0000</td>
            <td>Kshs 0</td>
        </tr>
        <tr>
            <td rowspan="2">XRP</td>
            <td>Available<br>0.00000</td>
            <td>Kshs 0</td>
        </tr>
        <tr>
            <td>Locked<br> 0.0000</td>
            <td>Kshs 0</td>
        </tr>

    </table>
 
</body>
</html>