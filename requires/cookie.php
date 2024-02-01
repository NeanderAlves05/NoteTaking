<?php
if(isset($_COOKIE["email"])|| isset($_COOKIE["id"])){
    //posso utilizzare il cookie
    $email=$_SESSION['email'];
    setcookie("email",$email,
    time()+(86400*30),"/");
    $user_id=$_SESSION['user_id'];
    setcookie("id",$user_id,
    time()+(86400*30),"/");
}
echo $_COOKIE["email"];
