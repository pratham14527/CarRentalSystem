<?php

require( '../configs/database.php');
if(isset($_POST['sumbit'])){

    $error= false;
    $error_email='';
    $error_password='';

    //our variables
    $email= htmlspecialchars($_POST['email']);
    $password=htmlspecialchars($_POST['password']);
    $confirmpassword=htmlspecialchars($_POST['confirmpassword']);

    // check if all field are not empty

    if(! empty($email)AND !empty($password)AND !empty($confirmpassword)){

        //check if the entered email is not exists in database
        $checkEmailExist=$databasedconnextion-> prepare('SELECTemail from admins where email=?');
        $checkEmailExist->execute(array($email));
        if($checkEmailExist->rowcount() >= 1){
            $error=true;
            $error_email='email already taken';
        } else{
            if($password=$confirmpassword){

                //save the admin
                $saveAdmin=$databasedconnextion->prepare('INSERT INTO admins(email,password)VALUES(?,?');
                $saveAdmin-> execute(array($email,sha1($password)));
                if($saveAdmin){
                    header('location:index.php');
                }else{
                    $error=true;
                    $error_email='error when creatind your account';
                }
            }else{
                $error=true;
                $error_password='password and confirm password are not match';
            }
        }
    } else{
        $error=true;
        $error_email='email required';
        $error_password='password required';
    }
     
}

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Car Rental System</title>
    <link rel=" stylesheet" href="../../assets/css/login.css">
</head>
<body>
   <h1> register as admin </h1>
   <form method="post">
    <?php
    if(isset($error)){
        ?>
        <div class="row">
        <div class ="error"><?=$error_email?></div>
        <div class ="error"><?=$error_password?></div>
        
</div>
        <?php
    } 
    
    ?>
   
    <div class="row">
        <label for ="email">email</label>
        <input type="email" name="email" autocomplete="off"
        placeholder="email@example.com">
</div>
<div class="row">
    <label for="password"> password</label>
    <input type="password" name="password">
</div>
<div class ="row">
    <label for="password"> confirm password</label>
    <input type ="password" name="confirm password">
</div>
</div>
<button type="sumbit" name="sumbit"> registration as admin</button>
<div class="links">
    <div class="links">
        <a href="../../index.php"> back to login</a>
</div>
</div>
</form>
</body>
</html>