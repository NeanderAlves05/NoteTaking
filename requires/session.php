<?php
session_start();
$logged_in=$_SESSION['logged_in'] ?? false;
//funzione per fare il login
function login($email){
	$_SESSION['logged_in']=true;
	$_SESSION['email']=$email;
}
//funzione per fare il logout
function logout(){
	$_SESSION=[];
	setcookie("id", "", time() - 3600);
	setcookie("email", "", time() - 3600);
	session_destroy();
	header("Location: login.php");
}
//funzione per fare il login
function require_login($logged_in){
	if($logged_in===false){
		header("Location: login.php");
		exit;
	}
}


?>