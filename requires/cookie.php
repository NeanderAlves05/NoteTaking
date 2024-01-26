<?php
if(!isset($_COOKIE["visits"])){
    //posso utilizzare il cookie
    $count=0;
    setcookie("visits",$count,
    time()+(86400*30),"/");
}else{
    $count=$_COOKIE["visits"]+1;
    setcookie("visits",$count,
    time()+(86400*30),"/");
}
echo $_COOKIE["visits"];