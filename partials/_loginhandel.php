<?php


if($_SERVER['REQUEST_METHOD']=="POST"){
    include '_dbconnect.php';
    $login_email=$_POST['loginEmail'];
    $login_password=$_POST['loginPassword'];
    $sql="SELECT * FROM `users` WHERE user_email ='$login_email'";
    $result=mysqli_query($conn,$sql);
    $numRow =mysqli_num_rows($result);
    if($numRow==1){
        $row=mysqli_fetch_assoc($result);
        $user_name=$row['user_name'];
        $user_id=$row['user_id'];
        if(password_verify($login_password,$row['user_password'])){
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['useremail']=$login_email;
            $_SESSION['loggedinusername']=$user_name;
            $_SESSION['usernameid']=$user_id;
            // echo $user_id;
            // echo "loggedin".$login_email;
            header("Location: /forums/index.php");
        }else{
            header("Location: /forums/index.php?loginfailed=true");
           
        }
    }


}
?>