<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    
</head>
<body>
    
<div class="deco">
<img src="images/logo/logo.png" height="90" width="90" alt="logo" class=" float-left"/>
<h3 class="text-center">
Mentor Mentee</h3>
<p class="text-center font-italic">Ask Here Anything</p>
</div>

<form action="logedin.php" method="POST">
  <div class="mx-auto mt-5 container" style="width: 350px;">
  <h4 class="text-center">Log In</h4>
  <div class="form-group">
    <label for="Username">Enter Username:</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="Entusername" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Enter Password:</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="Entpassword" required>
  </div>
  <div class="form-group form-check">
    <input type="checkbox" name="rememberme" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Remember Me</label>
    <p>Dont have an account yet? <a href="register.php">Sign Up</a></p>
    <p><a href="#">Forgot Password?</a></p>
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
  <div class="text-center">
  <button type="submit" class="btn btn-primary" name="sumb">Log In</button>
  </div>
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

<?php
    session_destroy();
?>