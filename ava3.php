<?php

include 'server.php';
session_start();
$reel = $_SESSION['username'];

 mysqli_query($con," UPDATE users SET Profile= 'images/Avatars/Male/mf_2.png' WHERE Username = '$reel' ");

header('location:profile.php');

?>