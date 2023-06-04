<?php
require 'credentials.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/forms.css">
    <title>Login - Pesabits</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" autocomplete="on">
        <a href="../index.php"><h1>Pesabits</h1></a>
        <br>
        <input type="button" id="google-login" value="Continue with GOOGLE">
        <input type="email" name="email" placeholder="Email address" value="<?php echo $email;?>" autocomplete="email" required>
        <input type="password" name="password" id="password" placeholder="Enter password" value="<?php echo $password;?>" autocomplete="current-password" required>
        <?php require 'formerror.php' ?>
        <input type="submit" name="login_user" value="LOGIN">
        <a href="#">I forgot password</a><br><br>
        <a href="signup.php">I want to create account</a>
        </form>
</body>
</html>