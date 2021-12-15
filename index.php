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

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/1.jpg" width="2400px" height="450px" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images/2.jpg" width="2400px" height="450px" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images/3.jpg" width="2400px" height="450px" class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>




    <div class="container my-3">
        <h1 class="text-center"> Let's Ask Forum -Categories</h1>
        <div class="row">

            <?php
      $sql="SELECT * FROM `categories`";
      $result=mysqli_query($conn,$sql);
      while ($row = mysqli_fetch_assoc($result)) {
    $catid=$row['category_id'];
        $cat=  $row['category_name'];
       $catdesc=  $row['category_description'];
        echo '
        <div class="col-md-4">
            <div class="card my-2" style="width: 18rem;">
                <img src="https://source.unsplash.com/500x400/?coding,programming,'.$cat.',language" class="card-img-top" alt="'.$cat.' image">
                <div class="card-body">
                    <h5 class="card-title text-center"><a href="threadlist.php?catid='.$catid.'">'.$cat.'</a></h5>
                    <p class="card-text">'.substr($catdesc,0,200).'...</p>
                    <a href="threadlist.php?catid='.$catid.'" class="btn btn-primary">View Threads</a>
                </div>
            </div>
        </div>
 ';
      }
      ?>





        </div>
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