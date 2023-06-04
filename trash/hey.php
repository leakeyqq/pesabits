//Hash the password
          $hashPassword = password_hash($password, PASSWORD_DEFAULT);

         //Test is a user exists with the following information

         
         $sql_check = "SELECT email FROM customer_info WHERE Email = ? AND secret_pass = ? LIMIT 1";
         $stmt = $pdo -> prepare($sql_check);
         //$stmt -> execute(array($email,$hashPassword));
         $stmt -> execute(array($email,$password));
         $exists = $stmt -> fetch();
         if(!$exists){
             array_push($formErrors, "You entered incorrect login credentials");
               }else{
                    session_start();
                    $_SESSION['user'] = $email;
                    header('location: ../index.php');
               }
          