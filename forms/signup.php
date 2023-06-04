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
    <title>Register - Pesabits</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" autocomplete="on">
        <a href="../index.php"><h1>Pesabits</h1></a>
        <br>
        <input type="button" id="google-login" value="Continue with GOOGLE">
        <input type="email" name="email" value="<?php echo $email;?>" placeholder="Email address" autocomplete="email" required>
        <input type="tel" name="phone" value="<?php echo $tel; ?>" placeholder="Phone number" autocomplete="tel" required minlength="10" maxlength="10">
        <input type="password" name="password" value="<?php echo $password; ?>" id="password" placeholder="New password" autocomplete="new-password" required minlength="3">
        <input type="password" name="confirm_password" value="<?php echo $repeat_password; ?>" id="confirm_password" placeholder="Confirm password" autocomplete="new-password" required minlength="3">
        <?php require 'formerror.php'; ?>
        <input type="submit" name="register_user" value="REGISTER" >
        <a href="login.php">I want to Login</a>
        </form>
</body>
</html>
 