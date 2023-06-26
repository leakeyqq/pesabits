
<header>
<h1>Pesabits</h1>
<h3>Crypto backed loans</h3>
</header>
<div class="topnav" id="myTopnav">
<a href="/pesabits/index.php" class="active">Home</a>
<a href="/pesabits/userwallet/balances.php">Crypto wallet</a>
<a href="#contact">Loans</a>
<a href="#about">Savings</a>
<a href="#">Text Us</a>

<?php if(isset($_SESSION['user'])){?>
<a href="index.php?logout='1'">Log out</a>
<?php }else{?>
<a href="/pesabits/forms/login.php">Login/Register</a>
<?php
}?>


<a href="javascript:void(0);" class="icon" onclick="myFunction()">
<i class="fa fa-bars"></i>
</a>
</div>
<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>