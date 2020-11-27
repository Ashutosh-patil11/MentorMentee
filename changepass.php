<?php

include 'server.php';
session_start();

if(!isset($_SESSION['username']))
 {
        header('location:login.php');
        $_SESSION['msg'] = "Password Sucessfully Changed Now Log In With New Password.";
}
if(isset($_POST['changepass']))
{

    $current = mysqli_real_escape_string($con, $_POST['currentpass']);
    $new = mysqli_real_escape_string($con, $_POST['newpass']);
    $new2 = mysqli_real_escape_string($con, $_POST['newpass2']);
    if($new === $new2)
    {
        $user = $_SESSION['username'];
        $q = " select *from users where Username = '$user' ";
        $res = mysqli_query($con, $q);
        if($res)
        {
            $currentps = mysqli_fetch_assoc($res);

            $currentp = $currentps['Password'];
            $pass_decode = password_verify($current, $currentp);

            if($pass_decode)
            {
                $newpassword = password_hash($new,PASSWORD_BCRYPT);

                $qu = " UPDATE users SET Password = '$newpassword' , RePassword = '$newpassword' WHERE Username = '$user' ";
                $qu_res = mysqli_query($con, $qu);
                if($qu_res)
                {
                    header('location:logedout.php');
                }

            }
            else
            {
                $_SESSION['msg'] = "Please Enter Correct Current Password";
            }

        }
    }
    else
    {
        $_SESSION['msg'] = "New Password and New Password again must be same. ";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
<a class="navbar-brand" href="#">
    <img src="images/logo/homelogo.svg" width="30" height="30" class="d-inline-block align-top" alt="">
    <b><span class="text-warning"> Mentor </span><span class="text-info"><i>Mentee</i></span></b>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item ">
        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">My Questions</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">My Answers</a>
      </li>
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php
                echo $_SESSION['username'];
        ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="profile.php"><i class='far fa-user-circle' style='font-size:20px'></i>&nbsp Profile</a>
          <a class="dropdown-item" href="logedout.php"><i class="fa fa-envelope-open" style='font-size:20px'></i>&nbsp MM Messenger</a>
          <a class="dropdown-item" href="logedout.php"><i class='fas fa-arrow-alt-circle-left' style='font-size:20px'></i>&nbsp Logout</a>
        </div>
      </li>
    </ul>
    <span class="navbar-text ml-auto">
      <div class="text-success"><b>Ask Here Anything</b></div> 
    </span>
  </div>
</nav>


<form action="" method="POST">
    <h5 class="mt-5 text-center text-danger">You Want to Change Password?</h5>
<div class="container pro ">
<div class="form-group">
    <label for="exampleInputPassword1">Enter Current Password:</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="currentpass" required>
</div>
<div class="form-group">
    <label for="exampleInputPassword1">Enter New Password:</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="newpass" minlength="8" required>
    <small class="form-text text-muted">Minimum 8 characters required
    </small>
</div>
<div class="form-group">
    <label for="exampleInputPassword1">Enter New Password Again:</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="newpass2" minlength="8" required>
</div>
<div class="text-white bg-danger text-center">  
          <p>
            <?php
                if(isset($_SESSION['msg']))
                {
                  echo $_SESSION['msg'];
                }
            ?>
          </p>
        </div>
<p class="text-info ">After Sucessfull Password Change, you will redirected on Log In page.</p>
<input type="submit" name="changepass" class="btn btn-primary" value="Change Password">

</div>
</form>


<footer class="mt-5">
                <div class="foot ">
                  <div class="text-center fot">
                    <h7><b>Mentor Mentee Community &copy; 2020</b></h7><br>
                    <small class="text-muted">All Rights Reserved</small></p>
                    <h7>Contact Us:</h7>
                    <a href="mailto:">mentor.mentee.community@gmail.com</a><i class="material-icons" style="font-size:20px;color:red">email</i><br>
                    <a href="#" ><i class='fab fa-facebook-square' style='font-size:36px'></i></a>
                    <a href="#"><i class='fab fa-instagram' style='font-size:36px'></i></a>
                    <a href="#"><i class='fab fa-twitter-square' style='font-size:36px'></i></a><br><br>
                    <p class="text-muted">Made in INDIA <i class="fas fa-heart"></i></p>
                    
                  </div>
                </div>
</footer>

<script src="js/jq.js"></script>
<script src="js/bootstrap.js"></script>

</body>
</html>