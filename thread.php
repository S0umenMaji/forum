<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Let's Ask</title>

</head>

<body>
  <?php include 'partials/_dbconnect.php' ; ?>
    <?php include 'partials/_header.php' ; ?>
    <?php
    $id=$_GET['threadid'];
    $sql="SELECT * FROM `threads` where thread_id='$id'";
    $result=mysqli_query($conn,$sql);
    while ($row = mysqli_fetch_assoc($result)) {
       $title=  $row['thread_title'];
      $desc=  $row['thread_des'];
      $uid=$row['thread_user_id'];
      $id=$row['thread_id'];
      $sql2="SELECT user_name FROM `users` WHERE user_id='$uid'";
        $result2= mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $posted_by =$row2['user_name'];
     }
    ?>
    <?php
    if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true){
    $showAlert=false;
    $method=$_SERVER['REQUEST_METHOD'];
    $uid=$_SESSION['usernameid'];
    if($method=='POST'){
        $comment_content=$_POST['comment'];
        $comment_content=str_replace("<","&lt;",$comment_content);
        $comment_content=str_replace(">","&gt;",$comment_content);
        // $comment_user=$_POST[''];
        $sql="INSERT INTO `comments` (`comment_content`, `comment_thread_id`, `comment_time`, `comment_by`) VALUES ( '$comment_content', '$id', current_timestamp(), '$uid')";
       $result=mysqli_query($conn,$sql);
       $showAlert=true;
       
    }
    if($showAlert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your Comment has been added.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }}
    
    ?>

    <div class="container my-4">

        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title;?> </h1>
            <p class="lead"><?php echo $desc;?></p>
            <p>Posted by:<b class="text-danger"> <em><?php echo $posted_by ;?></em></b></p>
            <hr class="my-4">
            <p>Forum Rules:
            <ul>
                <li>This is a peer to peer forum for sharing knowledge.</li>
                <li>No Spam / Advertising / Self-promote in the forums. </li>
                <li>Do not post copyright-infringing material.</li>
                <li>Do not post “offensive” posts, links or images.</li>
                <li>Remain respectful of other members at all times.</li>
            </ul>
            </p>

        </div>
    </div>

    <div class="container">
        <h1 class="py-2">Post a comment</h1>
        <?php
        if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true){

echo ' <form action=" '.$_SERVER["REQUEST_URI"].'" method="post">
        
            <div class="form-group">
                <label for="comment">Type Your comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-success">Submit</button>
        </form>';
    }else
    {
          echo'  <button class="btn btn-warning text-danger ml-2" type="button" data-toggle="modal" data-target="#loginModal">Please Login To start a comment</button>';
        }
        ?>
        
    </div>
    <div class="container">
        <h1 class="py-2">Discussion on this topic</h1>



        <?php
    $id=$_GET['threadid'];
     $sql="SELECT * FROM `comments` where comment_thread_id='$id'";
     $result=mysqli_query($conn,$sql);
     $noresult=true;
     while ($row = mysqli_fetch_assoc($result)) {
        $content=  $row['comment_content'];
      
       $cid=$row['comment_id'];
       $uid=$row['comment_by'];
        $comment_date=$row['comment_time'];
        $dati=strtotime($comment_date);
        $noresult=false;
       $sql2="SELECT user_name FROM `users` WHERE user_id='$uid'";
        $result2= mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_assoc($result2);
       
       echo '  <div class="media my-3">
       <img src="images/user-default.png"  width="56px" height="54px" class="mr-3 mt-2" alt="...">
       <div class="media-body">  
       <p class="font-weight-bold my-0">'.$row2['user_name'].'<small class="text-danger">'.date("d-m-Y h:i a", $dati).'</small> </p> 
         <p>'.$content.'</p>
       </div>
     </div>';
     }
     if($noresult){
        echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h3 class="display-7">No Answers Found!</h3>
          <p class="lead">Be The First person To Help</p>
        </div>
      </div>';
    }
    ?>
    </div>

    <?php include 'partials/_footer.php' ; ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
</body>

</html>