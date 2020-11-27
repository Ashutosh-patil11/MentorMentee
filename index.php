<?php
    include 'server.php';
    $show = " select *from posted
    left join topic on posted.post_topic = topic.topic_id
    left join users on posted.author = users.id
    order by Rand();
    ";
    $resshow = mysqli_query($con, $show);
    $count_resshow = mysqli_num_rows($resshow);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome To the Community</title>
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
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php"><button type="button" class="btn btn-success btn-sm">Sign Up</button></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php"><button type="button" class="btn btn-warning btn-sm">Log In</button></a>
      </li>
    </ul>
    <span class="navbar-text ml-auto">
      <div class="text-success"><b>Ask Here Anything</b></div> 
    </span>
  </div>
</nav>


<div class="container mt-3">
<nav class="navbar">
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Ask A Question
</button>
  <!-- Search Bar.-->
  <form class="form-inline mt-2">
    <input class="form-control mr-sm-2" type="search" placeholder="Search the User" aria-label="Search">
    <button class="btn  btn-success my-2 my-sm-0" type="submit"><i class='fas fa-search' style='font-size:24px'></i></button>
  </form>
</nav>
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Before Ask a Question You should be Log In to Mentor Mentee Community!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <a href="register.php"><button type="button" class="btn btn-success">Sign Up</button></a>
      <a href="login.php"><button type="button" class="btn btn-warning">Login</button></a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<?php
if($count_resshow)
{
while($row = mysqli_fetch_assoc($resshow))
{ ?>
<!--Start Timeline -->
<div class="card border-light timeline float-md-left" style="max-width: 50rem; min-width: 60%;">
  <div class="card-header">
    <img src="<?php echo $row['Profile']; ?>" alt="user image" class="rounded-circle float-left" height="50" width="50"/>
     <div class="usname"><span class="font-weight-bold"><?php echo $row['Username']; ?></span><br>
     <?php echo $row['topic_name'] ?> <i class="fa fa-tag" style="color:blue;"></i></div>
  </div>
  <div class="card-body body-bg">
    <h5 class="card-title mx-auto"> <a href="showindex.php?id=<?php echo $row['post_id'] ?>"><?php echo $row['post_title'] ?></a></h5>
    <p class="card-text"><?php echo $row['post_descri'] ?></p>
  <img src="<?php echo $row['post_img'] ?>" class=" img-thumbnail mx-auto d-block" alt="Post Image" style="max-height:500px;" />
                  <br>
  <p class="card-text text-center">
  <i class='fas fa-calendar-check' style='font-size:18px'><small class="text-muted">&nbsp<?php echo $row['post_date'] ?></small></i>
  <div class="text-center">
  <a href="showindex.php?id=<?php echo $row['post_id'] ?>"><i class='fas fa-comments' style='font-size:24px'><small class="text-muted">Mentors</small></i></a>
  </div>
  </p>
  </div> 
</div> 
<?php } }
else
{
  ?>
    <p class="text-center text-danger">There are no Questions</p> <?php
}
?>
<!-- Close Timeline -->



<ul class="list-group topic-list  mx-auto">
<button type="button" class="list-group-item list-group-item-action">Top 5 Questions of the previous Week!</button>
<button type="button" class="list-group-item list-group-item-action">Top 5 Questions of the previous month!</button>
<button type="button" class="list-group-item list-group-item-action">Top 5 Questions of all Time!</button><br>

<button type="button" class="list-group-item list-group-item-danger" style="border:none;" disabled>Top 5 Topics:</button>
<button type="button" class="list-group-item list-group-item-danger">Computer Science</button>
<button type="button" class="list-group-item list-group-item-danger">Web Series</button>
<button type="button" class="list-group-item list-group-item-danger">Sports</button>
<button type="button" class="list-group-item list-group-item-danger">Social Media</button>
<button type="button" class="list-group-item list-group-item-danger">Movies</button><br>

<button type="button" class="list-group-item list-group-item-action" style="border:none;" disabled>Other Topics:</button>
<button type="button" class="list-group-item list-group-item-warning">Science And Technology</button>
<button type="button" class="list-group-item list-group-item-warning">Space And Universe</button>
<button type="button" class="list-group-item list-group-item-warning">World Current Affair</button>
<button type="button" class="list-group-item list-group-item-warning">Physics And Electronics</button>
<button type="button" class="list-group-item list-group-item-warning">TV-Serials</button>
<button type="button" class="list-group-item list-group-item-warning">Actor</button>
<button type="button" class="list-group-item list-group-item-warning">Actress</button>
<button type="button" class="list-group-item list-group-item-warning">Life Style</button>
<button type="button" class="list-group-item list-group-item-warning">News Media</button>
<button type="button" class="list-group-item list-group-item-warning">History</button>
<button type="button" class="list-group-item list-group-item-warning">Geography</button>
<button type="button" class="list-group-item list-group-item-warning">Social Science</button>
<button type="button" class="list-group-item list-group-item-warning">World Economy</button>
<button type="button" class="list-group-item list-group-item-warning">Politician</button>
<button type="button" class="list-group-item list-group-item-warning">Political Party</button>
<button type="button" class="list-group-item list-group-item-warning">Commerce And Management</button>
<button type="button" class="list-group-item list-group-item-warning">Stock Market</button>
<button type="button" class="list-group-item list-group-item-warning">Adult Dating And Relationship</button>
<button type="button" class="list-group-item list-group-item-warning">Singing And Dancing</button>
<button type="button" class="list-group-item list-group-item-warning">Musical Instruments</button>
</ul>

<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.bundle.js"></script>

</body>
</html>