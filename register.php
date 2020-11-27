<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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


<form action="validation.php" method="POST">
    <div class=" was-validated float-left mt-5 ml-2">
        <h4 class="text-center">Sign Up</h4>
  <div class="form-group">
    <label for="Username">Username:</label>
    <input type="text" class="form-control" id="exampleInputPassword1" 
    minlength="5" name="username" required>
    <small class="form-text text-muted">Choose a username with minimum 5 characters may be alphabets
        and numbers
    </small>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email Address:</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="email" required>
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password:</label>
    <input type="password" class="form-control" id="exampleInputPassword1"  
    minlength="8" name="pass" required>
    <small class="form-text text-muted">Minimum 8 characters required
    </small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Confirm Password:</label>
    <input type="password" class="form-control" id="exampleInputPassword1" 
    minlength="8" name="repass" required>
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
    <label class="form-check-label" for="exampleCheck1"><a href="#">Accept Policy</a></label><br>
    <a href="login.php">I have already an account.</a>
  </div>
  <div class="text-white bg-danger text-center">  
          <p>
            <?php
                if(isset($_SESSION['error']))
                {
                  echo $_SESSION['error'];
                }
            ?>
          </p>
        </div>
  <div class="text-center">
  <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" 
   name="submit" title="Sign Up">Sign Up</button></div>
    </div>
</form>

<div class="card mt-5">
  <img src="images/MENTORMENTEE.png" class="img-thumbnail" alt="...">
  <div class="card-body">
    <h5 class="card-title"><b>Join Our Mentor Mentee Comunity</b></h5>
    <p class="card-text text-center">"Everyone is a Mentor for someone and everyone
         is a Mentee for someone".</p>
    <ul class="list">
        <li>
            You can choose any username to hind your identity like Anonymous.
        </li>
        <li>
            Consider yourself as intellactual. If you think that you are capable to answer a question anser it.
        </li>
        <li>
            You can ask here anything even you can conversation about controversy topics.
        </li>
        <li>
            Spreads the positive communication vibes.
        </li>
</ul>
    <p class="card-text text-center"><small class="text-muted">Ask Here Anything</small></p>
  </div>
</div>


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