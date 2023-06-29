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
        <script src="~/Scripts/autoNumeric/autoNumeric.min.js" type="text/javascript"></script>
        <script>
          //Toggle loan forms between stable and unstable coins
            function toggleForms() {
              var form1 = document.getElementById("loan-form");
              var form2 = document.getElementById("loan-form-stable-coins");

              if (form1.style.display === "none") {
                form1.style.display = "block";
                form2.style.display = "none";
              } else {
                form1.style.display = "none";
                form2.style.display = "block";
              }
            }
  </script>
    </head>
    <body>
        <?php
        require 'header.php';
        require 'others/getKshsRate.php';
        require 'others/savingOptions.php';
        require 'others/fetchLTVs.php';
        require 'others/fetchCoins.php';
        ?>
        <div class="front-introduction">
            <!--<p>Borrow money for your day to day activites</p>-->
            <p>Use your Bitcoin to get a Ksh loan</p>
        <div class="features-box">
        <div class="features-link" ><a href="#loanformlink">Borrow</a></div>
        <div class="features-link"><a href="#savingsformlink">Save</a></div>
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
                <p>Deposit your crypto asset that you will use as collateral for borrowing.</p>
            </div>
            <div class="procedure">
                <h4>Borrow</h4>
                
                <p>The loan is processed instantly and you receive money in your Mpesa account.</p>
            </div>
            <div class="procedure">
                <h4>Interest</h4>
                <p>For the first <b>7 days </b>the loan will earn zero interest.
                <p>Then onwards the loan will be earning a 0.3% interest daily on your balance.</p>
            </div>
            <div class="procedure">
                <h4>Loan repayment</h4>
                <p>There is no repayment duration. Please payback anytime you wish.</p>
            </div>
            </a>
        </div>
        


        <form class="loan-calculator" id="loan-form" style="display: block;" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <br><div class="form-instructions">
                <p><b>Loan form</b></p>
            </div>
          <label for="loan-amount">Amount to borrow in Kshs.</label><br>
            <input type="number" id="loanAmount" name="loanAmount" placeholder="Kshs 20,000" inputmode="numeric" autocomplete="off" value="0">
        
            <br><br><label for="coin">Select coin to use as collateral</label><br>
            
            <select name="collateral-coin" id="coin">
              <?php
              foreach($this_coins as $row){
                if($row['Stability'] == "non-stable"){
               echo "<option value='".$row['Token_short_name']."'>".$row['Token_full_name']."</option>";
                }
              }
              ?>

            </select>
            
            <a class="stable-coin-link" style="cursor: pointer;" onclick="toggleForms()">Use stable coin instead</a>
            
            <br>


            <?php
                foreach($this_rows as $row){
               echo "<br><br><label for='loanltv'>LTV ratio </label><output id='ltvoutput'>".$row['Default_value']."</output><span style='color: rgb(0, 0, 0);'>%. <a href='#aboutltv'>Learn more</a></span><br>";

             echo "<input type='range' name='loan-ltv' id='loanltv' value='".$row['Default_value']."' min='".$row['Min']."' max='".$row['Max']."' step='1' oninput='ltvoutput.value = loanltv.value'>";
            }
            ?>

<br><br><div class="collateral-needed">

    <span id="collateralNeeded"></span>
</div>
            <input type="button" id="borrow" value="Proceed to borrow">
        </form>        
        
        
        
        
            
       
        <form class="loan-calculator" id="loan-form-stable-coins" style="display:none;" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <br><div class="form-instructions">
                <p><b>Loan form</b></p>
            </div>
          <label for="loan-amount">Amount to borrow in Kshs.</label><br>
            <input type="number" id="loanAmount" name="loanAmount" placeholder="Kshs 20,000" inputmode="numeric" autocomplete="off" value="0">
        
            <br><br><label for="coin">Select coin to use as collateral</label><br>
            
            <select name="collateral-coin" id="coin">
              <?php
              foreach($this_coins as $row){
                if($row['Stability'] == "stable"){
               echo "<option value='".$row['Token_short_name']."'>".$row['Token_full_name']."</option>";
                }
              }
              ?>
            </select>
            
            <a class="stable-coin-link" style="cursor: pointer;" onclick="toggleForms()">Use non-stable coin instead</a>
            <br>
            <?php
                foreach($this_stableCoins_rows as $row){
               echo "<br><br><label for='loanltv'>LTV ratio </label><output id='ltvoutput'>".$row['Default_value']."</output><span style='color: rgb(0, 0, 0);'>%. <a href='#aboutltv'>Learn more</a></span><br>";

             echo "<input type='range' name='loan-ltv' id='loanltv' value='".$row['Default_value']."' min='".$row['Min']."' max='".$row['Max']."' step='1' oninput='ltvoutput.value = loanltv.value'>";
            }
            ?>

<br><br><div class="collateral-needed">

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
            <p>The higher the LTV you pick the lesser collateral you will deposit.</p>
            </a>
        </div>
        <div class="procedure">
            <h4>LTV alerts </h4>
            <p>Within the cause of the debt period the LTV ratio can go up or down due to fluctuations in the price of your collateral asset.</p>
            <p>Incase the LTV ratio rises up to 70%. We will alert you to add more collateral or repay some part of the loan to bring the LTV ratio down.</p>
            <p>If the LTV ratio reaches 85% we will swap your collateral asset into a stable coin like BUSD to prevent it from loosing more value.</p>
            <!--<p style="color: rgb(206, 47, 47);">Does not apply for collateral assets BUSD,DAI,USDC,TUSD & USDT because they are stable coins.</p>-->
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
        <form class="loan-calculator" id="savings-form" method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-instructions">
                <p><b>Locked savings</b></p>
            </div>
          <label for="savings-amount">Amount to save in Kshs.</label><br>
            <input type="number" id="savings-amount" name="savingsAmount" placeholder="Kshs 80,000" inputmode="numeric" value="0"><br><br>
            <label for="duration">Select lock duration</label>
            <select name="loan-duration" id="duration">
          <?php
          foreach($rows as $row){
            echo "<option value=".$row['Period_months'].">".$row['Period_months']." months at ".$row['APY']." APY"."</option>";
          }
          ?>
            </select>
            <br><br>
            <div class="collateral-needed">
                <span id="savingsOutput"></span>
            </div>
          
            <input type="button" id="saveNow" value="Proceed to pay">

        </form>
        <script type="text/javascript">
                     $(document).ready(function(){
                                  $("#duration").change(function(){
                                  var savingsDuration = $(this).val();
                                  $.ajax({
                                    url:"others/savingOptions.php",
                                    method: "POST",
                                    data:{
                                      savings_amount:$('#savings-amount').val(),
                                      savings_duration: savingsDuration
                                  },
                                    datatype: "text",
                                    success:function(html){
                                      $('#savingsOutput').html(html);
                                    }
                                  });
                          });

                          $("#savings-amount").keyup(function(){
                                  var savingsAmount = $(this).val();
                                  $.ajax({
                                    url:"others/savingOptions.php",
                                    method: "POST",
                                    data:{
                                      savings_amount:savingsAmount,
                                      savings_duration: $('#duration').val()
                                  },
                                    datatype: "text",
                                    success:function(html){
                                      $('#savingsOutput').html(html);
                                    }
                                  });
                          });
                    });
        </script>
        
    </body>
</html>