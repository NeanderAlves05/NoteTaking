<?php

if(isset($_SESSION["email"])|| isset($_SESSION["user_id"])){
    //posso utilizzare il cookie
    $email=$_SESSION['email'];
    setcookie("email",$email,
    time()+(86400*30),"/");
    $user_id=$_SESSION['user_id'];
    setcookie("id",$user_id,
    time()+(86400*30),"/");
}else{
    $_COOKIE['email']="NOT LOGGED";
}
?>