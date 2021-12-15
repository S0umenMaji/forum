<?php
session_start();
include 'partials/_dbconnect.php' ;
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="index.php"';echo ">Let's Ask</a>";
echo '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
      <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="about.php">About</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Top Categories    </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
      $sql="SELECT * FROM `categories`";
      $result=mysqli_query($conn,$sql);
      while ($row=mysqli_fetch_assoc($result)) {
        
       echo' <a class="dropdown-item" href="/forums/threadlist.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a>';
      }
        
      //   <!--<div class="dropdown-divider"></div>
      //   <a class="dropdown-item" href="#">Something else here</a>
      // </div>-->
      echo' </li>
   <li class="nav-item">
      <a class="nav-link " href="#" tabindex="-1" >Contact</a>
    </li>
  </ul>
  <div class="row mx-2">';

  if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true)
  {
    echo '<form class="form-inline my-2 my-lg-0"  method="get" action="/forums/search.php">
    <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
    <p class="text-light my-0 ml-2">Welcome '.$_SESSION['loggedinusername'].'</p>
    <a href="/forums/partials/_logout.php" class="btn btn-primary ml-2" type="button">Logout</a>
    </form>';
  }
  else{
 
 echo '<form class="form-inline my-2 my-lg-0"  method="get" action="/forums/search.php">
    <input class="form-control mr-sm-2" type="search" name="search"  placeholder="Search" aria-label="Search">
    <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
  </form>
      <button class="btn btn-outline-primary ml-2" type="button" data-toggle="modal" data-target="#loginModal">Login</button>
      <button class="btn btn-outline-primary mx-2" type="button"  data-toggle="modal" data-target="#signupModal">Signup</button>';
    
  }
    
    
    echo '</div>
    </div>
</nav>';

include 'partials/_loginmodal.php';
include 'partials/_signupmodal.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']==true ){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success!</strong> Your Account has been created,Please login.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
if(isset($_GET['signupfailed']) && $_GET['signupfailed']==true ){
  echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  <strong>Alert!</strong> Passwords do not match .
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
if(isset($_GET['loginfailed']) && $_GET['loginfailed']==true ){
  echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  <strong>Alert!</strong> Username or password do not match.Please login again .
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

if(isset($_GET['signupemailmatch'])&& $_GET['signupemailmatch']==true ){
  echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  <strong>Alert!</strong>Email already Present,Please Try another one .
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';

}

?>