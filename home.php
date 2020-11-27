<?php
    include 'server.php';
    session_start();

    if(!isset($_SESSION['username']))
    {
        header('location:login.php');
        $_SESSION['msg'] = "You are log out. Log in again.";
    }
    $limit = 2;
    if(isset($_GET['page']))
    {
      $page = $_GET['page'];
    }
    else
    {
      $page = 1;
    }
    $offset = ($page -1) * $limit;
    $use = $_SESSION['username'];
    $q = "select *from users where Username = '$use'";
    $rq = mysqli_query($con, $q);
    $user_profile = mysqli_fetch_assoc($rq);
    $_SESSION['email'] = $user_profile['Email'];
    $_SESSION['user_id'] = $user_profile['id'];
    $_SESSION['profile'] = $user_profile['Profile'];

    $show = " select *from posted
    left join topic on posted.post_topic = topic.topic_id
    left join users on posted.author = users.id
    order by id
    limit {$offset},{$limit}
    ";
    $resshow = mysqli_query($con, $show);
    $count_resshow = mysqli_num_rows($resshow);


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
          <a class="dropdown-item" href="logedout.php"><i class='fas fa-arrow-alt-circle-left' style='font-size:20px'></i>&nbsp; Logout</a>
        </div>
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
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
  Ask a Question
  </button>
  <!-- Search Bar.-->
  <form class="form-inline mt-2">
    <input class="form-control mr-sm-2" type="search" placeholder="Search the Topic" aria-label="Search">
    <button class="btn  btn-success my-2 my-sm-0" type="submit"><i class='fas fa-search' style='font-size:24px'></i></button>
  </form>
</nav>
  </div>


<!-- Modal Ask a que.-->
<div class="modal fade " id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Ask a Question. Be a Mentee!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body que">

      <div class="text-center">
      <img src="<?php echo $_SESSION['profile']; ?>" alt='...' class='rounded-circle' height='40' width='40' />
      <span class="text-muted"><?php echo $_SESSION['username']; ?></span>
      </div>

      <div class="mt-2">
      <form action="posted.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="title">Question<span class="text-danger">*</span> :</label>
        <input class="form-control" type="text" placeholder="Start with 'What?', 'How?', 'Why?', etc." name="title" required>
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Description about Question<span class="text-danger">*</span> :</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" required></textarea>
      </div>
      <div class="form-group">
        <label for="exampleFormControlSelect1">Select Topic Of Question<span class="text-danger">*</span> :</label>
        <select class="form-control" name="topic" id="exampleFormControlSelect1" style="width:200px;" required>
          <option value="" disabled selected>Choose Topic</option>
          <?php

                  $topic = " select *from topic";
                  $topic_res = mysqli_query($con, $topic);
                  if(mysqli_num_rows($topic_res) > 0)
                  {
                    while( $fetch_topic = mysqli_fetch_assoc($topic_res))
                    {
                        echo "<option> {$fetch_topic['topic_name']} </option>";
                    } 
                  }

          ?>
          
        </select>
        <p class="text-secondary">Make sure your question is about this topic.</p>
      </div>
      <div class="form-group">
      <label for="image">Attach Image<span class="text-danger">*</span>  :</label>
        <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" id="customFile" name="queupload" onchange=" preimage(event)" accept="image/png, image/jpeg, image/jpg" required>
            <label class="custom-file-label" for="customFile"><i class="fa fa-image" style="font-size:24px" ></i></label>
        </div>
         <img src="" id="img-upload" class="img-thumbnail"/>
      </div>
  </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-success" value="Post Question" name="postq">
      </div>
      </form>
      </div>
    </div>
  </div>
</div>

<?php
if($count_resshow)
{
  $count = 0;
while($row = mysqli_fetch_assoc($resshow))
{ $count ++; ?>
<!--Start Timeline -->
<div class="card border-light timeline float-md-left  " style="max-width: 50rem; min-width: 60%;">
  <div class="card-header">
    <img src="<?php echo $row['Profile']; ?>" alt="user image" class="rounded-circle float-left" height="50" width="50"/>
     <div class="usname"><span class="font-weight-bold"><?php echo $row['Username']; ?></span><br>
     <?php echo $row['topic_name'] ?> <i class="fa fa-tag" style="color:blue;"></i></div>
  </div>
  <div class="card-body body-bg">
    <h5 class="card-title mx-auto"> <a href="single.php?id=<?php echo $row['post_id'] ?>"><?php echo $row['post_title'] ?></a></h5>
    <p class="card-text"><?php echo $row['post_descri'] ?></p>
  <img src="<?php echo $row['post_img'] ?>" class=" img-thumbnail mx-auto d-block" alt="Post Image" style="max-height:500px;" />
                  <br>
  <p class="card-text text-center">
  <i class='fas fa-calendar-check' style='font-size:18px'><small class="text-muted">&nbsp<?php echo $row['post_date'] ?></small></i>
  <div class="text-center">
  <a href="single.php?id=<?php echo $row['post_id'] ?>"><i class='fas fa-comments' style='font-size:24px'><small class="text-muted">Mentors</small></i></a>
  </div>
  </p>
  </div> 

<!-- Pagination -->
<?php
if($count == 2){
$sql1 = "select *from posted ";
  $result1 = mysqli_query($con, $sql1);
  if(mysqli_num_rows($result1) > 0)
  {
    $total_records = mysqli_num_rows($result1);
    $total_page = ceil($total_records / $limit);
      echo '<nav aria-label="Page navigation example">';
      echo '<ul class="pagination justify-content-center">';
      if($page > 1)
      {
        echo '<li class="page-item"><a class="page-link" href="home.php?page='.($page - 1).'">Previous</a></li>';
      }
      for($i=1; $i <= $total_page; $i++)
      {
        if($i == $page)
        {
            $active = "active";
        }
        else
        {
          $active = "";
        }
        echo '<li class="page-item '.$active.'"><a class="page-link" href="home.php?page='.$i.'">'.$i.'</a></li>';
      }
      if($total_page > $page)
      {
        echo '<li class="page-item"><a class="page-link" href="home.php?page='.($page + 1).'">Next</a></li>';
      }
      echo '</ul>';
  }}

?>
<!-- Pagination End -->


</div> 
<?php } 
  
}
else
{
  ?>
    <p class="text-center text-danger">There are no Questions</p> <?php
}
?>
<!-- Close Timeline -->


<div class="clearfix">
<ul class="list-group topic-list  mx-auto justify-content">
<button type="button" class="list-group-item list-group-item-action">Top 5 Questions of the previous Week!</button>
<button type="button" class="list-group-item list-group-item-action">Top 5 Questions of the previous month!</button>
<button type="button" class="list-group-item list-group-item-action">Top 5 Questions of all Time!</button><br>

<button type="button" class="list-group-item list-group-item-danger " style="border:none;" disabled>Top 5 Topics:</button>
<button type="button" class="list-group-item list-group-item-danger">Computer Science</button>
<button type="button" class="list-group-item list-group-item-danger">Web Series</button>
<button type="button" class="list-group-item list-group-item-danger">Sports</button>
<button type="button" class="list-group-item list-group-item-danger">Social Media</button>
<button type="button" class="list-group-item list-group-item-danger">Movies</button><br>

<button type="button" class="list-group-item list-group-item-action " style="border:none;" disabled>Other Topics:</button>
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
<button type="button" class="list-group-item list-group-item-warning">Games</button>
<button type="button" class="list-group-item list-group-item-warning">Competitive Exams</button>
<button type="button" class="list-group-item list-group-item-warning">Religions</button>
<button type="button" class="list-group-item list-group-item-warning">Culture And Human Behaviour</button>
</ul>
</div>

<footer class="mt-5 footer">
                  <div class="text-center ">
                    <h7><b>Mentor Mentee Community &copy; 2020</b></h7><br>
                    <small class="text-muted">All Rights Reserved</small></p>
                    <h7>Contact Us:</h7>
                    <a href="mailto:">mentor.mentee.community@gmail.com</a><i class="material-icons" style="font-size:20px;color:red">email</i><br>
                    <a href="#" ><i class='fab fa-facebook-square' style='font-size:36px'></i></a>
                    <a href="#"><i class='fab fa-instagram' style='font-size:36px'></i></a>
                    <a href="#"><i class='fab fa-twitter-square' style='font-size:36px'></i></a><br><br>
                    <p class="text-muted">Made in INDIA <i class="fas fa-heart"></i></p>
                </div>
</footer>


<script>
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>

<script type="text/javascript">

  function preimage(event)
  {
    var reader = new FileReader();
    var imgfield = document.getElementById("img-upload");

    reader.onload = function()
    {
      if(reader.readyState == 2)
      {
        imgfield.src = reader.result;
      }
    }
    reader.readAsDataURL(event.target.files[0]);
  }
</script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.bundle.js"></script>

</body>
</html>