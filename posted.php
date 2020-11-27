<?php
 include 'server.php';
 session_start();
 

 if(isset($_POST['postq']))
 {
     $que_title = mysqli_real_escape_string($con, $_POST['title']);
     $que_descri = mysqli_real_escape_string($con, $_POST['description']);
     $que_topic = mysqli_real_escape_string($con, $_POST['topic']);
     $date = date("j F Y") . date(", g:i A ");
     echo $date ;

     $filename = $_FILES["queupload"]["name"];
     $tmpname = $_FILES["queupload"]["tmp_name"];
     $folder = "Queposts/". rand() . $filename;
     if($upload = move_uploaded_file( $tmpname, $folder))
     {
        $path = $folder;
     }

     $user_id = $_SESSION['user_id'];

     $query = " select *from topic where topic_name = '$que_topic' ";
     $que_res = mysqli_query($con, $query);
     $que_fetch = mysqli_fetch_assoc($que_res);
     
     $que_topic_id = $que_fetch['topic_id'];

     $insert_post = " insert into posted(post_title, post_descri, post_date, post_img, post_topic, author) 
                      values('$que_title','$que_descri','$date','$path','$que_topic_id','$user_id') ";
     $res_post = mysqli_query($con, $insert_post);
     if($res_post)
     {
        $no_post = " UPDATE topic SET number_post = number_post + 1 WHERE topic_id = '$que_topic_id' ";
        mysqli_query($con, $no_post);
         header('location:home.php');
     }

 }


?>
