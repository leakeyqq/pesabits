<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deposit</title>
    <link rel="stylesheet" href="../css/userwallet.css">
    <link rel="stylesheet" href="../css/nav_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php
    include '../header.php';
    include 'wallet_nav.php'
    ?>
    <div class="deposit">
        <h2>Deposit cryptocurrency</h2>
        <br>
        <label for="coins">Select coin</label>
        <select name="coins" id="coin">
            <option value="BTC">BTC</option>
            <option value="ETH">ETH</option>
            <option value="BNB">BNB</option>
            <option value="LTC">LTC</option>
            <option value="XRP">XRP</option>
        </select>
        <br>
        <br>
        <label for="network">Select network</label>
        <select name="network" id="network">
            <option value="BEP20">BNB Smart chain(BEP20)</option>
            <option value="BEP2">BNB Beacon Chain(BEP2)</option>
            <option value="BITCOIN">Bitcoin</option>
            <option value="ERC20">Ethereum (ERC20)</option>
        </select>
        <br>
        <br>
        <p>Send the crypto to this address <span style="word-wrap: break-word;" class="address"><b>bnb7yyqznvmvmkfpo8ffbfjju837374fj999a1203</b></span></p>
    </div>
</body>
</html>