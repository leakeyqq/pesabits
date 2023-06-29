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
        </head>
    <body>
    <?php
       require '../header.php';
        require '../others/getKshsRate.php';
        require '../others/savingOptions.php';
        ?>


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
                                    url:"saving_Options.php",
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
                                    url:"saving_options.php",
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