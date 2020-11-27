<?php

include 'server.php';
session_start();

$use_id =  $_SESSION['user_id'];

$que_show = " select *from posted
left join topic on posted.post_topic = topic.topic_id
left join users on posted.author = users.id
where posted.author = '$use_id' ";

$result = mysqli_query($con,$que_show);
$res_count = mysqli_num_rows($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/profile.css">
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
      <li class="nav-item ">
        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
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


<?php
if($res_count)
{ 
  while($row = mysqli_fetch_assoc($result))
  {  ?>
<div class="mx-auto">
<div class="card border-light mb-3 timeline float-md-left " style="max-width: 50rem; min-width: auto;">
  <div class="card-header">
    <img src="<?php echo $row['Profile']; ?>" alt="user image" class="rounded-circle float-left" height="50" width="50"/>
     <div class="usname"><span class="font-weight-bold"><?php echo $row['Username']; ?></span><br>
     <?php echo $row['topic_name'] ?> <i class="fa fa-tag" style="color:blue;"></i></div>
  </div>
  <div class="card-body body-bg">
    <h5 class="card-title mx-auto"> <a href="single.php?id=<?php echo $row['post_id'] ?>"><?php echo $row['post_title'] ?></a></h5>
    <p class="card-text"><?php echo $row['post_descri'] ?></p>
  <img src="<?php echo $row['post_img'] ?>" class=" img-thumbnail mx-auto d-block" alt="Post Image">
                  <br>
  <p class="card-text text-center">
  <i class='fas fa-calendar-check' style='font-size:18px'><small class="text-muted">&nbsp<?php echo $row['post_date'] ?></small></i>
  <div class="text-center">
  <a href="single.php?id=<?php echo $row['post_id'] ?>"><i class='fas fa-comments' style='font-size:24px'><small class="text-muted">Mentors</small></i></a>
  </div>
  </p>
  </div> 
</div>
  </div>
  <?php  }}
  else
  {
    ?>
    <p class="text-center text-danger">This Question have not any mentors yet! Reply to become a first Mentor.</p> <?php
  }
?>

<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.bundle.js"></script>

</body>
</html>