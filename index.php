<?php
session_start();
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    unset($_SESSION['userid']);
  	header("location: forms/login.php");
  }
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Borrow - Pesabits</title>
        <link rel="stylesheet" href="css/styles.css">
        <meta name="description" content="Apply for a crypto backed loan in kenya">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/nav_style.css">

      <!-- Latest compiled and minified CSS  *Bootstrap*-->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
      <!-- Latest compiled JavaScript  *Bootstrap*-->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <?php
        require 'header.php';
        ?>
        <div class="front-introduction">
            <p>Use your Bitcoin to get a Ksh loan</p>
        <div class="features-box">
        <div class="features-link" ><a href="#loanformlink">Borrow</a></div>
        <div class="features-link"><a href="#savingsformlink">Save</a></div>
        </div>
        </div>
        <div class="loan-procedure">
        <?php
            ?>

            <a name="loanformlink">
            <div class="procedure">
            <h2>Taking a loan</h2><br>
                <h4>Deposit crypto</h4>
                <p>Deposit your crypto asset that you will use as collateral for borrowing. These are the supported coins.</p>
                <ul class="list-inline">
                <li class="list-inline-item">
                  <img src="cryptoIcons/btc.png" alt="Icon 1" class="img-fluid">
                </li>
                <li class="list-inline-item">
                  <img src="cryptoicons/bnb.png" alt="Icon 2" class="img-fluid">
                </li>
                <li class="list-inline-item">
                  <img src="cryptoIcons/usdt.png" alt="Icon 3" class="img-fluid">
                </li>
                <li class="list-inline-item">
                  <img src="cryptoIcons/ltc.png" alt="Icon 1" class="img-fluid">
                </li>
                <li class="list-inline-item">
                  <img src="cryptoicons/eth.png" alt="Icon 2" class="img-fluid">
                </li>
                <li class="list-inline-item">
                  <img src="cryptoIcons/usdc.png" alt="Icon 3" class="img-fluid">
                </li>
                <li class="list-inline-item">
                  <img src="cryptoIcons/aave.png" alt="Icon 1" class="img-fluid">
                </li>
                <li class="list-inline-item">
                  <img src="cryptoicons/dai.png" alt="Icon 2" class="img-fluid">
                </li>
                <li class="list-inline-item">
                  <img src="cryptoIcons/tusd.png" alt="Icon 3" class="img-fluid">
                </li>
                <li class="list-inline-item">
                  <img src="cryptoIcons/doge.png" alt="Icon 1" class="img-fluid">
                </li>
                <li class="list-inline-item">
                  <img src="cryptoicons/ada.png" alt="Icon 2" class="img-fluid">
                </li>
                <li class="list-inline-item">
                  <img src="cryptoIcons/crpt.png" alt="Icon 3" class="img-fluid">
                </li>
                <!-- Add more <li> elements for additional icons -->
              </ul>
            </div>
            <div class="procedure">
                <h4>Borrow</h4>
                
                <p>The loan is processed instantly and you receive money in your Mpesa account.</p>
            </div>
            <div class="procedure">
                <h4>Interest</h4>
                <p>For the first 7 days the loan will earn zero interest. Then onwards the loan will be earning a 0.3% interest daily on your balance.</p>
            </div>
            <div class="procedure">
                <h4>Loan repayment</h4>
                <p>There is no repayment duration. Payback anytime you wish.</p>
                <p><a href="/pesabits/userwallet/applyloan.php"> <button class="btn btn-primary">Proceed to borrow <span class="spinner-border spinner-border-sm"></span></button></a></p>
            </div>
            </a>
        </div>
        <hr>
        <div class="loan-procedure">
        <div class="procedure">
        <h2>Locked savings</h2>
        <br>
                <h4>Open account</h4>
                <p>Choose the period you want to save your money for. It can be 6 or 12 months</p>
            </div>
            <div class="procedure">
                <a name="savingsformlink">
                </a>
                <h4>Deposit</h4>
                <p>Deposit any amount from your Mpesa. Bank deposits are also supported.</p>
            </div>
            <div class="procedure">
                <h4>Interest</h4>
                <P>Earn upto 25% interest if you save for 12 months.
                <p>You will withdraw your money when the period you have chosen matures.</p>
                <p><a href="/pesabits/userwallet/save.php"> <button class="btn btn-primary">Proceed to save <span class="spinner-border spinner-border-sm"></span></button></a></p>
            </div>
            </div>
        
    </body>
</html>