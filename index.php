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
        <script src="js/jquery-3.7.0.js"></script>

        <script type="text/javascript">
                function updateSavings() {
                    let dollarUSLocale = Intl.NumberFormat('en-US');
                    //get form
                    var form = document.getElementById("savings-form");
                    //get output
                    var out = form.elements["z"];
                    var profit = form.elements["profit"];
                    //get two numbers
                    var deposit = parseInt(form.elements["savingsAmount"].value);
                    var duration = parseInt(form.elements["loan-duration"].value);
                    var interest;
                    if(duration == 360){
                        interest = 20;
                    }else if(duration == 180){
                        interest = 15;
                    }else{
                        interest = 11;
                    }
                    var amountBack = deposit + (interest/100 * deposit * duration/360);
                    var interest_amount = interest/100 * deposit * duration/360;
                    if(isNaN(amountBack)){
                        out.value = 0;
                        profit.value = 0
                    }else{
                        interest_amount = interest_amount.toFixed(0);
                        profit.value = dollarUSLocale.format(interest_amount);
                        amountBack = amountBack.toFixed(0);
                        out.value = dollarUSLocale.format(amountBack);   
                    }
            }
</script>
<script src="~/Scripts/autoNumeric/autoNumeric.min.js" type="text/javascript"></script>
    </head>
    <body>
        <?php
        include 'header.php';
        ?>
        <div class="front-introduction">
            <!--<p>Borrow money for your day to day activites</p>-->
            <p>Use your Bitcoin to get a loan</p>
        <div class="features-box">
        <div class="features-link" ><a href="#loanformlink">Borrow</a></div>
        <div class="features-link"><a href="#savingsformlink">Earn</a></div>
        </div>
        </div>
        <div class="loan-procedure">
        <?php
        if(!isset($_SESSION['user'])){?>

            <div class="procedure">
                <h4>Create account</h4>
                <p>This takes only a few seconds and no kyc is required. <a href="forms/signup.php">Register/Login</a></p>
            </div>
            <?php
        }
            ?>

            <a name="loanformlink">
            <div class="procedure">
                <h4>Deposit assets</h4>
                <p>Deposit your crypto coins that you will use as collateral for borrowing.</p>
            </div>
            <div class="procedure">
                <h4>Borrow</h4>
                
                <p>The loan is processed instantly and you receive money in your Mpesa account.</p>
            </div>
            <div class="procedure">
                <h4>Pay back</h4>
                <p>There is no loan duration. You can payback anytime you want.</p>
                <P>The interest is calculated monthly on your remaining loan balance.</P>
            </div>
            </a>
        </div>
        
        <form class="loan-calculator" id="loan-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <br><div class="form-instructions">
                <p><b>Borrow at 5% monthly interest</b></p>
            </div>
          <label for="loan-amount">Amount to borrow in Kshs.</label><br>
            <input type="text" id="loanAmount" name="loanAmount" placeholder="Kshs 20,000" inputmode="numeric" autocomplete="off" value="0">
        
            <br><br><label for="coin">Coin to use as collateral</label><br>
            
            <select name="collateral-coin" id="coin">
                <option value="BTCUSDT">Bitcoin BTC</option>
                <option value="ETHUSDT">Ethereum ETH</option>
                <option value="DOGEUSDT">Dogecoin DOGE</option>
                <option value="LTCUSDT">Litecoin LTC</option>
                <option value="SHIBUSDT">Shiba Inu SHIB</option>
            </select>

            <br><br><label for="loanltv">LTV ratio </label><output id="ltvoutput">50</output><span style="color: rgb(0, 0, 0);">%. <a href="#aboutltv">Learn more</a></span><br>
<input type="range" name="loan-ltv" id="loanltv" value="50" min="30" max="50" step="1" oninput="ltvoutput.value = loanltv.value">
<br><br><div class="collateral-needed">
    <!--<p>Collateral needed 0.001 Bitcoin BTC.</p>-->
    <span id="collateralNeeded"></span>
</div>
            <input type="button" id="borrow" value="Proceed to borrow">
        </form>
        <script type="text/javascript">
           $(document).ready(function(){

            //Change in loan amount
              $("#loanAmount").keyup(function(){
                var loan = $(this).val();
                $.ajax({
                  url:"checkloan.php",
                  method: "POST",
                  data:{
                    loan_amount:loan,
                    coin_chosen: $('#coin').val(),
                    ltv_chosen: $('#loanltv').val(),
                },
                  datatype: "text",
                  success:function(html){
                    $('#collateralNeeded').html(html);
                  }
                });
              });

              //Change in collateral coin
              $("#coin").change(function(){
                var thisCoin = $(this).val();
                $.ajax({
                  url:"checkloan.php",
                  method: "POST",
                  data:{
                    loan_amount:$('#loanAmount').val(),
                    coin_chosen: thisCoin,
                    ltv_chosen: $('#loanltv').val()
                },
                  datatype: "text",
                  success:function(html){
                    $('#collateralNeeded').html(html);
                  }
                });
              });

              //Change in ltv ratio
              $("#loanltv").on('input',function(){
                var thisRate = $(this).val();
                $.ajax({
                  url:"checkloan.php",
                  method: "POST",
                  data:{
                    loan_amount:$('#loanAmount').val(),
                    ltv_chosen: thisRate,
                    coin_chosen: $('#coin').val()
                },
                  datatype: "text",
                  success:function(html){
                    $('#collateralNeeded').html(html);
                  }
                });
              });

            });
        </script>

        <div class="loan-procedure">
        <div class="procedure">
            <a name="aboutltv">
            <h4>What is Loan to Value(LTV) ratio</h4>
            <p>It is calculated by dividing the loan amount by the amount of collateral.</p>
            <!--<p>Choosing a high LTV when borrowing is risky.</p>-->
            <p>The higher the LTV ratio you pick the lesser collateral you will deposit.</p>
            </a>
        </div>
        <div class="procedure">
            <h4>LTV alerts </h4>
            <p>Within the cause of the debt period the LTV ratio can go up or down due to fluctuations in the price of your collateral asset.</p>
            <p>Incase the LTV ratio rises up to 70%. We will alert you to add more collateral or repay some part of the loan to bring the LTV ratio down.</p>
            <p>If the LTV ratio reaches 80% we will swap your collateral asset into a stable coin like BUSD.</p>
        </div>
        </div>
        <hr>
        <div class="loan-procedure">
            <div class="procedure">
                <a name="savingsformlink">
                <h2>Fixed savings</h2>
                </a>
                <br>
                <h4>Deposit</h4>
                <p>Deposit any amount from Kshs 500 using Mpesa.</p>
                <p>Then choose the lock duration to lock your money.</p>
            </div>
            <div class="procedure">
                <h4>Interest</h4>
                <p>After the lock period finishes you will be able to withdraw your money plus interest.</p>
            </div>
            </div>
        <form class="loan-calculator" id="savings-form" method="post" oninput="updateSavings()">
            <div class="form-instructions">
                <p><b>Locked savings</b></p>
            </div>
          <label for="savings-amount">Amount to save in Kshs.</label><br>
            <input type="text" id="savings-amount" name="savingsAmount" placeholder="Kshs 80,000" inputmode="numeric" value="0"><br><br>
            <label for="duration">Select lock duration</label>
            <select name="loan-duration" id="duration">
                <option value="360">12 months at 20% APY</option>
                <option value="180">6 months at 15% APY</option>
            </select>
            <br><br><label for="profit">Interest to earn Kshs <output name="profit" for="profit">0</output></label>
            <br><br><label for="amountBack">Amount to receive back Kshs <output name="z" for="amount clients">0</output></label>
            

            <br><br>
            <input type="button" id="saveNow" value="Proceed to pay">

        </form>
        
    </body>
</html>