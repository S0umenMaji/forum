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
    $id=$_GET['catid'];
     $sql="SELECT * FROM `categories` where category_id='$id'";
     $result=mysqli_query($conn,$sql);
     while ($row = mysqli_fetch_assoc($result)) {
        $cat=  $row['category_name'];
       $catdesc=  $row['category_description'];
     }
    ?>
    <?php
    if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true){
    $showAlert=false;
    $method=$_SERVER['REQUEST_METHOD'];
//    $sql="SELECT * from `users`";
//     $result=mysqli_query($conn,$sql);
    $uid=$_SESSION['usernameid'];
    if($method=='POST'){
        $th_title=$_POST['title'];
        $th_desc=$_POST['desc'];
        $th_title=str_replace("<","&lt;",$th_title);
        $th_title=str_replace(">","&gt;",$th_title);

         $th_desc=str_replace("<","&lt;", $th_desc);
         $th_desc=str_replace(">","&gt;", $th_desc);
        $sql="INSERT INTO `threads` (`thread_title`, `thread_des`, `thread_user_id`, `thread_category`, `timestamp`) VALUES ( '$th_title', '$th_desc', '$uid', '$id', current_timestamp())";
       $result=mysqli_query($conn,$sql);
       $showAlert=true;
       
    }
    if($showAlert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your question has been submitted.Please wait for our community to respond.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }}
    
    ?>

    <div class="container my-4">

        <div class="jumbotron">
            <h1 class="display-4">Welcome To <?php echo $cat;?> Forums</h1>
            <p class="lead"><?php echo $catdesc;?></p>
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

            <a class="btn btn-primary btn-lg" href="#" role="button">Browse Topics</a>
        </div>
    </div>





    <div class="container">
        <h1 class="py-2">Start a Discussion</h1>

        <?php
// session_start();
if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true){

      echo ' <form action=" '.$_SERVER["REQUEST_URI"].'" method="post">
        <div class="form-group">
            <label for="title">Thread Title</label>
            <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text text-muted">Keep your title small and sweet.</small>
        </div>
        <div class="form-group">
            <label for="desc">Describe your Problem</label>
            <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-success">Submit</button>
        </form>';
        }
        else{
        echo' 
      
    <button class="btn btn-warning text-danger ml-2" type="button" data-toggle="modal" data-target="#loginModal">Please Login To start a discussion</button>';
        }
        ?>


    </div>
    <div class="container my-3">
        <h1 class="py-2">Browse Questions</h1>
        <?php
    $id=$_GET['catid'];
    $noresult=true;
     $sql="SELECT * FROM `threads` where thread_category='$id'";
    
     $result=mysqli_query($conn,$sql);
     while ($row = mysqli_fetch_assoc($result)) {
         $noresult=false;
        $title=  $row['thread_title'];
       $desc=  $row['thread_des'];
     
       $thread_time=$row['timestamp'];
       $tid=$row['thread_id'];
       $dati=strtotime($thread_time);
       $uid=$row['thread_user_id'];
       $sql2="SELECT user_name FROM `users` WHERE user_id='$uid'";
        $result2= mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_assoc($result2);
         

       echo '  <div class="media my-3">
       <img src="images/user-default.png"  width="56px" height="54px" class="mr-3 mt-2" alt="...">
       <div class="media-body">
       <p class="font-weight-bold my-0">'.$row2['user_name'].' <small class="text-dark"> '.date("d-m-Y h:i a", $dati).'</small></p> 
         <h5 class="mt-0"><a class="text-danger" href="thread.php?threadid='.$tid.'">'.$title.'</a></h5>
         <p>'.$desc.'</p>
       </div>
     </div>';    
     }
     if($noresult){
         echo '<div class="jumbotron jumbotron-fluid">
         <div class="container">
           <h3 class="display-7">No Questions Found!</h3>
           <p class="lead">Be The First person To ask</p>
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