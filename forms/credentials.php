<?php
date_default_timezone_set('Africa/Nairobi');
require 'dbconnections/connection.php';

//Variables for signup
$email = $tel = $password = $repeat_password = "";

$formErrors = array();

/* Register user */
if(isset($_POST['register_user'])){
     $email = $_POST['email'];
     $tel = $_POST['phone'];
     $password = $_POST['password'];
     $repeat_password = $_POST['confirm_password'];

     //Validate input
     if(empty($email)){
          array_push($formErrors,"Email is required");    
     }else if(empty($tel)){
          array_push($formErrors, "Phone number is required");
     }else if(empty($password) || empty($repeat_password)){
          array_push($formErrors,"Password is required");
     }else if($password != $repeat_password){
          array_push($formErrors,"The passwords do not match");
     }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
          array_push($formErrors, "Enter correct email format");
     }else if(!is_numeric($tel)){
          array_push($formErrors, "Enter digits only in phone number");
     }else if(strlen($tel) != 10){
          array_push($formErrors, "Phone number must have 10 digits only");
     }else{
          //Test is a user exists with the following information
          $sql_check = "SELECT email FROM customer_info WHERE Email = ? OR Telno = ? LIMIT 1";
          $stmt = $pdo -> prepare($sql_check);
          $stmt -> execute(array($email,$tel));
          $exists = $stmt -> fetch();
          if($exists){
               array_push($formErrors, "A user wth the following information already exists");
          }

     }


     if(count($formErrors) == 0){
          
          //Hash user password
          $hashPassword = password_hash($password, PASSWORD_DEFAULT);

          //Insert user info
          $sql = "INSERT INTO customer_info (Email,Telno,secret_pass,date_joined,time_joined) VALUES(?,?,?,?,?)";
          $stmt= $pdo->prepare($sql);
          $current_date =  date('Y-m-d');
          $current_time =  date('H:i:s');
          $stmt->execute([$email,$tel,$hashPassword,$current_date,$current_time
     ]);
          //$stmt->execute([$email,$tel,$password]);

          //Fetch user id
          $sql_check = "SELECT id FROM customer_info WHERE Email = ?  LIMIT 1";
          $stmt = $pdo -> prepare($sql_check);
          $stmt -> execute(array($email));
          $exists = $stmt -> fetch();
          $userid = $exists['id'];

          session_start();
          $_SESSION['user'] = $email;
          $_SESSION['userid'] = $userid;
          header('location: ../index.php');
     }
}

/* Login user */
if(isset($_POST['login_user'])){
     $email = $_POST['email'];
     $password = $_POST['password']; 
     
     if(empty($email)){
          array_push($formErrors,"Email is required");    
     }else if(empty($password)){
          array_push($formErrors, "Password is required");
     }else{
         //Test is a user exists with the following information
         
         $sql_check = "SELECT id,secret_pass FROM customer_info WHERE Email = ?  LIMIT 1";
         $stmt = $pdo -> prepare($sql_check);
         $stmt -> execute(array($email));
         $exists = $stmt -> fetch();
         if($stmt->rowCount() != 0){
         $hashed_pass = $exists['secret_pass'];
         $userid = $exists['id'];  
         if(password_verify($password,$hashed_pass)){
               session_start();
               $_SESSION['user'] = $email;
               $_SESSION['userid'] = $userid;
               header('location: ../index.php');
         }else{
          array_push($formErrors, "You entered incorrect login credentials");
         }

     }else{
          array_push($formErrors, "You entered incorrect login credentials");
     }

     }

}

$pdo = null;
?>