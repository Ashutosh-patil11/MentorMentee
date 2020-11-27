<?php

include 'server.php';

session_start();

$sub = mysqli_real_escape_string($con,$_POST['submit']);

if(isset($sub))
{
    $username = mysqli_real_escape_string($con,$_POST['username']);
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $pass = mysqli_real_escape_string($con,$_POST['pass']);
    $repass = mysqli_real_escape_string($con,$_POST['repass']);

   // $password = password_hash($pass, PASSWORD_BCRYPT);
   // $repassword = password_hash($repass, PASSWORD_BCRYPT);

    $usernamequery = "select * from users where Username = '$username' ";
    $res1 = mysqli_query($con,$usernamequery);
    $usernamecount = mysqli_num_rows($res1);

    $emailquery = " select * from users where Email = '$email' ";
    $res2 = mysqli_query($con,$emailquery);
    $emailcount = mysqli_num_rows($res2);

    if($usernamecount > 0)
    {
      $_SESSION['error']="Username is Already exists, Please choose another username.";
      header('location:register.php');
    }
    else if($emailcount > 0)
    {
        $_SESSION['error']="Your Email is already sign up. Please log in.";
        header('location:register.php');
    }
    else if($pass !== $repass)
    {
        $_SESSION['error']="Password and Confirm Password does not match";
        header('location:register.php');

    }
    else
    {
        $password = password_hash($pass, PASSWORD_BCRYPT);
        $repassword = password_hash($repass, PASSWORD_BCRYPT);
        $temp_profile = 'images/blank.jpg';
        $insertquery = " insert into users(Username, Email, Password, RePassword, Profile) 
                         values('$username','$email','$password','$repassword',' $temp_profile') ";
        $resultinsert = mysqli_query($con, $insertquery);
        if($resultinsert)
        {
            header('location:login.php');
            $_SESSION['msg'] = "You are sucessfully registered. Log in now.";
        }
    }
    
}















?>