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
<style>
#maincontainer {
    min-height: 100vh;
}
</style>

<body>
    <?php include 'partials/_dbconnect.php' ; ?>
    <?php include 'partials/_header.php' ; ?>
    <div class="container my-3" id="maincontainer">
        <?php
        error_reporting(0);
        $query=$_GET['search'];
        $noresult=true;
        $sql="SELECT * FROM `threads` WHERE MATCH (thread_title,thread_des) against ('$query')";
        $result=mysqli_query($conn,$sql);
        $i=0;
        $numRow =mysqli_num_rows($result);
        echo '<h1 class="mb-5">'.$numRow.' Search Results Found for <em>';echo'"'.$query.'"</em></h1>';
        
        while ($row = mysqli_fetch_assoc($result)) {
            $i=$i+1;
            $title=  $row['thread_title'];
            $noresult=false;
            $desc=  $row['thread_des'];
            $tid=$row['thread_id'];
            
        echo ' <div class="container"> <div class="result">
      <h3 class="display-7"> <a href="/forums/thread.php?threadid='.$tid.'" class="text-dark"> '.$i.') '.$title.'</a> </h3>
      <p class="lead ">'.$desc.'</p>
      </div> </div>';
    }
    if($noresult){
        echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h3 class="display-7">Sorry, we couldn\'t find any results for <em><b>"'.$query.'"</em></b></h3>
          <p class="lead">
          Try adjusting your search. Here are some ideas:
         <ul>  <li>Make sure all words are spelled correctly</li>
          <li>Try different search terms</li>
          <li>Try more general search terms</li></ul></p>
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