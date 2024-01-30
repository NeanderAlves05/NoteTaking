<?php
session_start();
$logged_in=$_SESSION['logged_in'] ?? false;
$user_email='';
//funzione per fare il login
function login($email){
	$_SESSION['logged_in']=true;
	$user_email=$email;
	$_SESSION['email']=$email;
}
//funzione per fare il logout
function logout(){
	$_SESSION=[];
	session_destroy();
	header("Location: login.php");
}
//funzione per fare il login
function doLogin($logged_in){
	if($logged_in===false){
		header("Location: login.php");
		exit;
	}
}


?>