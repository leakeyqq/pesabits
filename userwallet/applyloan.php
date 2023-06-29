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
        <link rel="stylesheet" href="../css/styles.css">
        <meta name="description" content="Apply for a crypto backed loan in kenya">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/nav_style.css">
        <script src="../js/jquery-3.7.0.js"></script>
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
       require '../header.php';
        require '../others/getKshsRate.php';
        require '../others/fetchLTVs.php';
        require '../others/fetchCoins.php';
        ?>

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
              $(document).ready(function() {
                // Change in loan amount for the first form
                $("#loanAmount").keyup(function() {
                  updateCollateralNeeded();
                });

                // Change in collateral coin for the first form
                $("#coin").change(function() {
                  updateCollateralNeeded();
                });

                // Change in LTV ratio for the first form
                $("#loanltv").on("input", function() {
                  updateCollateralNeeded();
                });

                // AJAX request handling for the first form
                function updateCollateralNeeded() {
                  var loan = $("#loanAmount").val();
                  var coin = $("#coin").val();
                  var ltv = $("#loanltv").val();

                  $.ajax({
                    url: "check_collateral_needed.php",
                    method: "POST",
                    data: {
                      loan_amount: loan,
                      coin_chosen: coin,
                      ltv_chosen: ltv
                    },
                    datatype: "text",
                    success: function(html) {
                      $("#collateralNeeded").html(html);
                    }
                  });
                }

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
    </body>