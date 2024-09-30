<?php
require('./configs/database.php');
session_start();
//check if button is clicked
if(isset($_POST['sumbit'])){

 // check if the chebox are check

 $logadmin=$_POST['log_admin'];
$error=false;
$error_email='';
$error_password='';

$email=htmlspecialchars($_POST['email']);
$password=htmlspecialchars($_POST['pass$password']);

if(!empty($email)AND !empty($password)){
    if(isset($logadmin)){
        //login as admin
        //check if the email is reconize in our database*
        $checkEmailExists=$databaseConnextion-> prepare('SELECT email from admins where email =?');
        $checkEmailExists-> execute(array($email));
        if($checkEmailExists->rowcount()>=1){
        }else{
            $error=true;
        }
     }else{
        //login as customer
    }}else{
    $error=true;
    $error_email='email required';
    $error_password='password required';
}
 
    echo 'you will proceed to log as admin';
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
   <h1> login to  your dashboard </h1>
  <form method="post">
    <div class="row">
        <label for="email">Email<label>
        <input type="email" name="email" autocomplete="off"
        placeholder="email@example.com">
    </div>
  <div class="row">
    <label for="password">password</label>
    <input type="password" name="password">
  </div>
<div style="display: flex;color:#8086a9;
">
<input type="checkbox" name="login_admin">
<label for="">log as admin</label>
</div>
<div style="display: flex;color:#8086a9;
">
<div class="links">
<a href="/views/customer/signin" class="link">create an account</a>
<a href="/views/admin/registration" class="link"> admin account</a>
</div>
</div>
<button type ="sumbit" name="sumbit">login</button>
</form>
</body>
