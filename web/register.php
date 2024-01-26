<?php
include '../requires/connection.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //recupero i dati dal form
    $nome=ucfirst(strtolower($_POST['nome']));
    $cognome=ucfirst(strtolower($_POST['cognome']));
    $email=strtolower($_POST['email']);
    $password = md5($_POST['password']);

    $sql = "SELECT email FROM users WHERE email LIKE '$email'";

    $res = $conn->query($sql);
    //verifico se l email non è stata già registrata
    if($res->num_rows == 0) {
        $sql = "INSERT INTO users(nome, cognome, email, password)
        VALUES('$nome','$cognome','$email','$password')";
        if ($conn->query($sql) === TRUE) {
            header("Location: login.php");
            exit;
        } else {
            echo "Errore " . $conn->error;
        }
    }else{
        
        header("Location: login.php");
        exit;
    }
}
?>
<div>
    <div >
        <h1 >NoteTaking</h1>
        <div >
            <p>Registrati o Accedi per visualizzare le note</p>
        </div>
    </div>
    <form method="POST" action="register.php">
        <div>
            <label for="nome" >Nome</label>
            <input type="text" id="nome" name="nome" required maxlenght="30">
        </div>
        <div>
            <label for="cognome">Cognome</label>
            <input type="text" id="cognome" name="cognome" required maxlenght="70">
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required maxlenght="100">
   </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required maxlenght="50">
        </div>
        <button type="submit">Registrati</button>
    </form>
    <h3>Hai già un account? <a href="login.php">Accedi</a></h3>
</div>
<?php
?>