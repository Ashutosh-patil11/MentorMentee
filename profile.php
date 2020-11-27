<?php

    include 'server.php';
    session_start();

    if(!isset($_SESSION['username']))
    {
        header('location:login.php');
        $_SESSION['msg'] = "You are log out. Log in again.";
    }
    error_reporting(0);

    $filename = $_FILES["profilepic"]["name"];
    $tempname = $_FILES["profilepic"]["tmp_name"];
    $folder = "Users/" .rand(). $filename;

    $picres = move_uploaded_file( $tempname,$folder);

     if($picres)
     {
       $user = $_SESSION['username'];
       $qu = "select *from users where Username ='$user' ";
       $res_pic = mysqli_query($con,$qu);
       $pic_count = mysqli_num_rows($res_pic);

       if($pic_count)
       {
         $pic_fetch = mysqli_fetch_assoc($res_pic);

         $profie_path = $pic_fetch['Profile'];

          $extension = pathinfo($folder);
          if($extension['extension'] =='jpg' || $extension['extension'] =='jpeg' || $extension['extension'] =='png' || $extension['extension'] == 'gif')
          {
              $ins = " UPDATE users
              SET Profile ='$folder'
              WHERE Username = '$user' ";
              $final = mysqli_query($con,$ins);
          }
          else
          {
            ?>
            <script> alert("Hey do not upload document upload a picture !")</script> 
            <?php
          }
       }
      }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
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



<div class="container text-center pro mt-4">
  <h3>Profile</h3>
  <?php

      $use = $_SESSION['username'];
      $q = "select *from users where Username = '$use'";
      $rq = mysqli_query($con, $q);
      if(mysqli_num_rows($rq))
      {
        $user_profile = mysqli_fetch_assoc($rq);
        $only_pic = $user_profile['Profile'];
        $only_mail =  $user_profile['Email'];

        if($only_pic == '')
        {
          echo "<img src='images/blank.jpg' alt='...' class='rounded-circle' height='150' width='150'><br><br>";
        }
        else
        {
          echo "<img src='$only_pic' alt='...' class='rounded-circle' height='150' width='150'><br><br>";   
        }
      }

  ?>
  <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
  Change Profile Picture
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Select Avatar Or Choose Your Picture</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <a href="ava1.php"><img src="images/Avatars/Male/mf_1.png" alt="..." class=" rounded-circle" height="50" width="50"></a>
      <a href="ava2.php"><img src="images/Avatars/Female/mm_1.png" alt="..." class=" rounded-circle" height="50" width="50"></a>
      <a href="ava3.php"><img src="images/Avatars/Male/mf_2.png" alt="..." class=" rounded-circle" height="50" width="50"></a>
      <a href="ava4.php"><img src="images/Avatars/Female/mm_3.png" alt="..." class=" rounded-circle" height="50" width="50"></a>
      <a href="ava5.php"><img src="images/Avatars/Male/mf_3.png" alt="..." class=" rounded-circle" height="50" width="50"></a>
      <a href="ava6.php"><img src="images/Avatars/Male/mf_4.png" alt="..." class=" rounded-circle" height="50" width="50"></a>
      <a href="ava7.php"><img src="images/Avatars/Female/mm_4.png" alt="..." class=" rounded-circle" height="50" width="50"></a>
      <a href="ava8.php"><img src="images/Avatars/Male/mf_5.png" alt="..." class=" rounded-circle" height="50" width="50"></a>
      <a href="ava9.php"><img src="images/Avatars/Female/mm_5.png" alt="..." class=" rounded-circle" height="50" width="50"></a>
      <a href="ava10.php"><img src="images/Avatars/Male/mf_6.png" alt="..." class=" rounded-circle" height="50" width="50"></a>
      <a href="ava11.php"><img src="images/Avatars/Female/mm_6.png" alt="..." class=" rounded-circle" height="50" width="50"></a>
      <a href="ava12.php"><img src="images/Avatars/Male/mf_7.png" alt="..." class=" rounded-circle" height="50" width="50"></a>
      <a href="ava13.php"><img src="images/Avatars/Female/mm_7.png" alt="..." class=" rounded-circle" height="50" width="50"></a>
      <a href="ava14.php"><img src="images/Avatars/Male/mf_8.png" alt="..." class=" rounded-circle" height="50" width="50"></a>
      <a href="ava15.php"><img src="images/Avatars/Female/mm_8.png" alt="..." class=" rounded-circle" height="50" width="50"></a>
      <a href="ava16.php"><img src="images/Avatars/Male/mf_9.png" alt="..." class=" rounded-circle" height="50" width="50"></a>
      <a href="ava17.php"><img src="images/Avatars/Female/mm_9.png" alt="..." class=" rounded-circle" height="50" width="50"></a>
      <a href="ava18.php"><img src="images/Avatars/Male/mf_10.png" alt="..." class=" rounded-circle" height="50" width="50"></a>
      <a href="ava19.php"><img src="images/Avatars/Female/mm_10.png" alt="..." class=" rounded-circle" height="50" width="50"></a>
      <a href="ava20.php"><img src="images/Avatars/Male/mf_11.png" alt="..." class=" rounded-circle" height="50" width="50"></a>
      <a href="ava21.php"><img src="images/Avatars/Female/mm_11.png" alt="..." class=" rounded-circle" height="50" width="50"></a>
      <a href="ava22.php"><img src="images/Avatars/Female/mm_12.png" alt="..." class=" rounded-circle" height="50" width="50"></a>
      <a href="ava23.php"><img src="images/Avatars/Female/mm_13.png" alt="..." class=" rounded-circle" height="50" width="50"></a><br>

      <form action="" method="POST" enctype="multipart/form-data">
      <br><h6>Or</h6><br>
      <h6>Upload Your Picture</h6>
      <div class="mx-auto custom-file">
        <input type="file" name="profilepic" id="propic" accept="image/png, image/jpeg, image/jpg">
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Save Change" name="upload">
      </div>
      </form>
    </div>
  </div>
</div>
<br><br>

<div class="container">
<h4><?php echo $_SESSION['username'];?></h4>
<p><?php echo $_SESSION['email'];?></p><br>
<h6 class="hh">Become a Mentor : </h6>
<h6 class="hh">Become a Mentee : </h6>
<br>
 <a href="changepass.php" class="float-right">Change Password</a>

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