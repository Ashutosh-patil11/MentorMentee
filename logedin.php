<?php

include 'server.php';
session_start();

$sub = mysqli_real_escape_string($con,$_POST['sumb']);

if(isset($sub))
{
    $username = mysqli_real_escape_string($con,$_POST['Entusername']);
    $password = mysqli_real_escape_string($con,$_POST['Entpassword']);

    $user_qu = "select *from users where Username = '$username' ";
    $res_username = mysqli_query($con, $user_qu);
    $user_count = mysqli_num_rows($res_username);

    if($user_count)
    {
        $user_pass = mysqli_fetch_assoc($res_username);

        $db_pass = $user_pass['Password'];

        $_SESSION['username'] =  $user_pass['Username'];

        $pass_decode = password_verify($password,$db_pass);
        if($pass_decode)
        {
            header('location:home.php');
        }
        else
        {
            $_SESSION['msg'] = "Password is incorrect";
            header('location:login.php');
        }
    }
    else{
            $_SESSION['msg'] = "Username is incorrect";
            header('location:login.php');
    }
}






?>