<?php
include( '../requires/session.php');
include '../requires/connection.php';
include '../requires/cookie.php';
$msg='';
if($logged_in){
	$sql = "SELECT id FROM users WHERE email LIKE '$email'";
	$result=$conn->query($sql);
	$_SESSION['user_id']=$result->fetch_assoc();
    $_SESSION['email']=$email;
	header("Location: index.php");
	exit;
}
if($_SERVER['REQUEST_METHOD']=== 'POST'){
	$email=strtolower($_POST['email']);
    $password = md5($_POST['password']);
    $sql = "SELECT email,password FROM users WHERE email LIKE '$email' AND password LIKE'$password'";
	$result=$conn->query($sql);
	if($result->num_rows>0){
		login($email);
        $_SESSION['email']=$email;
		$sql="SELECT id from users where email like '$email'";
		$res=$conn->query($sql);
		$row=$res->fetch_assoc();
		$id_user=$row['id'];
		$_SESSION['user_id']=$id_user;
		header("Location:index.php");
		exit;
	}else{
        $msg='<p style="color: red;"> <b>*password o email errata</b></p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../res/css/util.css">
	<link rel="stylesheet" type="text/css" href="../res/css/main.css">
<!--===============================================================================================-->
	<link rel="icon" href="../trade.png">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<a >
					<div class="login100-pic ">
						<img src="../res/img-01.png" alt="IMG">
					</div>
				</a>
				<form class="login100-form validate-form" method="POST" action="login.php">
					<span class="login100-form-title">
						Member Login
					</span>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
                    <?php echo $msg ?>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="register.php">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
