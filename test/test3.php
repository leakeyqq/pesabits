<form class="loan-calculator" id="loan-form-stable-coins" style="display:block;" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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

