<?php
include '../requires/session.php';
include '../requires/connection.php';

$msg='';
if($logged_in){
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
		header("Location:index.php");
		exit;
	}else{
        $msg='<p style="color: red;">password o email errata</p>';
    }
}
?>
<div>
    <div >
        <h1 >Note Taking</h1>
        <div >
            <p>Accedi per visualizzare le note</p>
        </div>
    </div>
    <form method="POST" action="login.php">
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
   </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Accedi</button>
    </form>
	<?php echo $msg; ?>
    <h3>Ti devi registrare? <a href="register.php">Registrati</a></h3>
</div>