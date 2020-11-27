<?php

include 'server.php';
session_start();

$post_id = $_GET['id'];

$sin = "select *from posted
        left join topic on posted.post_topic = topic.topic_id
        left join users on posted.author = users.id 
        where posted.post_id ='$post_id'";

$res = mysqli_query($con,$sin);

$comment_show = "select *from comments 
                 left join users on comments.co_user = users.id
                 left join posted on comments.co_post = posted.post_id  
                 where comments.co_post ='$post_id' ";
$res_com = mysqli_query($con,$comment_show);
$com_count = mysqli_num_rows($res_com);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Question</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/view.css">
    <script src="js/jq.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="myQuestion.php">My Questions</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php
                echo $_SESSION['username'];
        ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="profile.php"><i class='far fa-user-circle' style='font-size:20px'></i>&nbsp; Profile</a>
          <a class="dropdown-item" href="logedout.php"><i class="fa fa-envelope-open" style='font-size:20px'></i>&nbsp; MM Messenger &nbsp; <span class="badge badge-danger">4</span></a>
          <a class="dropdown-item" href="logedout.php"><i class='fas fa-arrow-alt-circle-left' style='font-size:20px'></i>&nbsp; Logout</a>
        </div>
      </li>
    </ul>
    <span class="navbar-text ml-auto">
      <div class="text-success"><b>Ask Here Anything</b></div> 
    </span>
  </div>
</nav>

<!--- Question display start-->
<?php
 while($row = mysqli_fetch_assoc($res))
 {
 ?>
<div class="mx-auto mt-3 text-center">
<div class="fi">
<img src="<?php echo $row['Profile']  ?>" alt="user image" class="rounded-circle" height="85" width="85"  />
<p><span class="unsname"><?php echo $row['Username']  ?></span></p>
</div>
<h4><?php echo $row['post_title']  ?></h4>
<img src="<?php echo $row['post_img']  ?>" class="img-thumbnail" alt="Responsive image" />
<p class="text-center mt-2 post-descri"><?php echo $row['post_descri']  ?></p>
</div>
<?php  
}?>

<?php
  if(isset($_POST['reply']))
  {
     $com = mysqli_real_escape_string($con,$_POST['comment']);
     $date = date("j F Y") . date(", g:i A ");
     $user_co_id = $_SESSION['user_id'];
     $post_co_id = $post_id;

     $comment_query = " insert into comments(comment, co_user, co_post, co_date) values('$com','$user_co_id','$post_co_id','$date')";
     mysqli_query($con, $comment_query);  
     $referer = $_SERVER['HTTP_REFERER'];
      header("Location: $referer");
    
  }


?>


<!-- Coomet Box -->
<div class="container pb-cmnt-container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card card-info">
                <div class="card-block">
                <form actiion="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form-inline">
                    <textarea placeholder="Be a Mentor!" class="pb-cmnt-textarea" maxlength="255" name="comment" required></textarea>
                        <input type="submit" value="Reply" class="btn btn-primary float-xs-right" name="reply">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- box end -->
<?php 
if($com_count)
{ 
  while($row_com = mysqli_fetch_assoc($res_com))
  {  ?>
<!-- comment show -->
<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card card-info comment">
                <div class="card-block ">
                 <div class="float-left image">
                   <img src="<?php echo $row_com['Profile'] ?>" alt="User Photo" class="rounded-circle" height="50" width="50" />
</div>
<div class="float-left meta nm">
                        <div class="title h5">
                            <a href="#"><b><?php echo $row_com['Username'] ?></b></a>
                        </div>
                        <h6 class="text-muted time"><?php echo $row_com['co_date'] ?></h6>
                    </div>
                </div>
                <div class="comment-description"> 
                    <p><?php echo $row_com['comment'] ?></p>
</div></div></div></div></div>
  <?php } }
  else 
  { ?>
    <p class="text-center text-danger">This Question have not any mentors yet! Reply to become a first Mentor.</p> <?php
   } ?>
<!-- Comment end -->


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

<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.bundle.js"></script>
</body>
</html>