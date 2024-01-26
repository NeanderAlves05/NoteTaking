<?php
include '../requires/session.php';
doLogin($logged_in);
include '../requires/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>NoteTaking</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
	
</head>
<body>
<nav class="navbar bg-body-tertiary ">
	<div class="container-fluid">
		<a class="navbar-brand" href="profile.php"> Profile</a>
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
                <span class="font-weight-bold">Benvenut* ".$nome.'</span><span class="text-black-50">'.$email.'</span><span> </span></div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <div class="row mt-2">
                        <input type="hidden" name="id" value='.$id.'> 

                        <div class="col-md-6"><label class="labels">Nome</label><input name="nome" type="text" class="form-control" value="'.$nome.'" onclick =" this.value = "" " required></div>
                        <div class="col-md-6"><label class="labels">Cognome</label><input type="text" name="cognome" class="form-control" value="'.$cognome.'" required></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"><label class="labels">Email</label><input name="email" type="email" class="form-control" value="'.$email.'" required></div>
                        <div class="col-md-6"><label class="labels">Data di Nascita</label><input name="date" type="date" class="form-control" value="'.$data.'" required></div>
                    </div>
                    <div class="mt-5 "><button class="btn btn-primary profile-button" type="submit">Save</button></div>
                    <div class="mt-5 "><button class="btn btn-primary profile-button" type="submit">Save</button></div>
                    
                </div>
            </div>
        </div>
    </form>
	</div>
	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	
</body>
</html>

