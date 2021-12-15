<?php

$showError="false";
if($_SERVER['REQUEST_METHOD']=="POST"){
    include '_dbconnect.php';
    $user_email=$_POST['signupEmail'];
    $user_name=$_POST['userName'];
    $password=$_POST['signupPassword'];
    $cpassword=$_POST['signupcPassword'];
    // $exists=false;
    $existSql="SELECT * FROM `users` WHERE user_email ='$user_email'";
    $resultSQL=mysqli_query($conn,$existSql);
    $numRow =mysqli_num_rows($resultSQL);
    if($numRow>0){
      header("Location: /forums/index.php?signupemailmatch=true");
    }
    else{
     
    
  if(($password == $cpassword))
  {
    $hash = password_hash($password,PASSWORD_DEFAULT);
    $sql="INSERT INTO `users` ( `user_email`, `user_password`, `timestamp`,`user_name`) VALUES ( '$user_email', '$hash', current_timestamp(),'$user_name');";
    $result=mysqli_query($conn,$sql);
    echo $result;
    if($result){
      $showAlert=true;
      header("Location: /forums/index.php?signupsuccess=true");
    }
  }
  else{
    header("Location: /forums/index.php?signupfailed=true");
  }
}


}

?>