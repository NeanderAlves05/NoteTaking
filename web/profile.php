<?php
include '../requires/session.php';
doLogin($logged_in);
include '../requires/connection.php';
include '../requires/cookie.php';

$disable="disabled";
$btnText="Modify";
$enable="?mod=true";

if(isset($_GET['mod'])== true){
	$disable="";
	$enable="";
}
$email=$_COOKIE['email'];
$sql="SELECT nome,cognome,email FROM users WHERE email = '$email'";
$res=$conn->query($sql);
if ($res->num_rows > 0) {
	$row = $res->fetch_assoc();
	$nome = $row['nome'];
	$cognome= $row['cognome'];
	$email = $row['email'];
}

if(!empty($_POST)){
	$nome = $_POST['nome'];
	$cognome= $_POST['cognome'];
	$email = $_POST['email'];
	$query_insert= 
	"UPDATE users set nome='$nome',cognome='$cognome',email='$email' where users.email='$email'";
	$risultato_query=mysqli_query($conn, $query_insert);
	if(!$risultato_query){
		die("Errore nella query $query_insert".mysql_error());
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>NoteTaking</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../res/css/main.css">
	<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
		/* Aggiungi stili CSS personalizzati qui */
		.container {
			margin-top: 20px;
		}

		/* Stili aggiuntivi per il form */
		.labels {
			margin-top: 10px;
		}

		/* Stili per il pulsante "Modify" e "Save" */
		.profile-button {
			margin-top: 10px;
		}
	</style>
</head>
<body>
<nav class="navbar bg-body-tertiary ">
    <div class="container">
      <a class="navbar-brand " href="index.php"><strong>NoteTaking</strong></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">NoteTaking</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="profile.php">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
        </ul>
      </div>
      </div>
    </div>
</nav>
	<hr class="featurette-divider">
	<div class="conteiner">
	    <!--PROFILE SHOW OFF-->
      	<form class="container rounded bg-white mt-5 mb-5" action="profile.php" method="post">
			<div class="row">
				<div class="col-md-3 border-right">
					<div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
					<span class="font-weight-bold">Benvenut* <?php echo $nome;?></span><span class="text-black-50"><?php echo $email;?></span><span> </span></div>
				</div>
				<div class="col-md-5 border-right">
					<div class="p-3 py-5">
						<div class="d-flex justify-content-between align-items-center mb-3">
							<h4 class="text-right">Profile Settings</h4>
						</div>
						<div class="row mt-2">
							<div class="col-md-6"><label class="labels">Nome</label>
							<input name="nome" for="nome" type="text" class="form-control" value="<?php echo $nome;?>" required <?php echo $disable;?>></div>

							<div class="col-md-6"><label class="labels">Cognome</label><input type="text" name="cognome" for="cognome" class="form-control" value="<?php echo $cognome;?>" required <?php echo $disable;?>></div>
						</div>
						<div class="row mt-3">
							<div class="col-md-6"><label class="labels">Email</label><input name="email" type="email" class="form-control" value="<?php echo $email;?>" required <?php echo $disable;?>></div>
							
						</div>
						<div class="row-mt-2">
							<div class="col-md-6 ">
								<a class="btn btn-primary profile-button" href="profile.php<?php echo $enable;?>">Modify
								</a>
								<button class="btn btn-primary profile-button" type="submit">Save</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<script>
		function changeState(){
			header("Location: profile.php?mod=true");
		}
	</script>
	
</body>
</html>

