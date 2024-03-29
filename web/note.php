<?php
include_once( '../requires/session.php');
include '../requires/connection.php';
include '../requires/cookie.php';
$email=$_COOKIE['email'];
$user_id=$_COOKIE['id'];
$titolo="";
$content="";
$category="-";
$folder="-";
if(isset($_GET['nId'])){
    $note_id=$_GET['nId'];
    $isnew=false;
    $sql = "SELECT * FROM notes WHERE notes.id like '$note_id'";
    $result = $conn->query($sql);
    if($result->num_rows>0){
        // Estrai i dati dalla riga risultato
        $note=$result->fetch_assoc();
        $note_id = $note['id'];
        $id_user = $note['id_user'];
        $id_category = $note['id_category'];
        $titolo = $note['title'];
        $content = $note['content'];
        $last_update = $note['last_update'];
        // Puoi anche eseguire una seconda query per ottenere la categoria
        $category_sql = "SELECT descriz FROM categories WHERE id = $id_category";
        $category_result = $conn->query($category_sql);
        $category_row = $category_result->fetch_assoc();
        $category = $category_row['descriz'];    
    }
}else{
    $isnew=true;
}
//inserisco i dati nel database
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    //recupero i dati dal form
    $titolo=$_POST['title'];
    $content=$_POST['content'];
    $id_category=$_POST['category'];
    $id_folder=$_POST['folder'];
    if($id_category=="-"){
        $id_category=7; //uncategorized
    }
    if($id_folder=="-"){
        $folder=3; //default folder
    }
    if(!$isnew){
        // Codice per l'aggiornamento di una nota esistente
        $query_update = " UPDATE notes 
        SET title = '$titolo',
            content = '$content',
            id_category = '$id_category',
            last_update = NOW()
        WHERE notes.id = '$note_id'";
        $result_update = $conn->query($query_update);
        if ($result_update) {
            // Ora eseguiamo la query di aggiornamento nella tabella note_folder
            $sql_folder = "UPDATE note_folder SET id_folder = '$id_folder' 
            WHERE id_note = '$note_id'";
            $result_folder = $conn->query($sql_folder);
            if ($result_folder) {
            echo "Nota aggiornata con successo";
            } else {
            die("Errore nell'aggiornamento della tabella note_folder: " . $conn->error);
            }
        } else {
        die("Errore nell'aggiornamento della tabella notes: " . $conn->error);
        }
    }else{
        // Codice per l'inserimento di una nuova nota
        $sql = "INSERT INTO notes (id_user, title, content, id_category) 
        VALUES ('$user_id', '$titolo', '$content', '$id_category')";
        $result = $conn->query($sql);
        if ($result) {
        // Se l'inserimento nella tabella notes è riuscito, otteniamo l'ID della nota appena inserita
        $id_note = $conn->insert_id;
        // Ora eseguiamo la query di inserimento nella tabella note_folder
        $sql_folder = "INSERT INTO note_folder (id_note, id_folder) 
                VALUES ('$id_note', '$id_folder')";
        $result_folder = $conn->query($sql_folder);

        if ($result_folder) {
        echo "Nota inserita con successo";
        } else {
        die("Errore nell'inserimento nella tabella note_folder: " . $conn->error);
        }
        } else {
        die("Errore nell'inserimento nella tabella notes: " . $conn->error);
        }
    }
    header("Location: index.php");
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
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="profile.php">Profile</a>
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
<div class="container">
<div class="container">
    <div class=" text-center mt-5 ">
        <h1 >NoteTake</h1>   
    </div>
    <div class="row ">
      <div class="col-lg-7 mx-auto">
        <div class="card mt-2 mx-auto p-4 bg-light">
            <div class="card-body bg-light">
            <div class = "container">

            <form action="note.php?nId=<?php echo $note_id?>" method="post">
            <div class="controls">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input id="title" type="text" name="title" class="form-control" placeholder="Title" required="required" data-error="Please specify a title" value="<?php echo $titolo ?>">
                        </div>
                    </div>
                    <div class="col-md-6">   
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                            <label for="content">Content</label>
                            <textarea id="content" name="content" class="form-control" placeholder="Write your note here" rows="4" required="required" data-error="Write the note" value=""><?php echo $content ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select id="category" name="category" class="form-control" data-error="Please specify the category" required="required">
                                <option value="-"><?php echo $category ?></option>
                                <?php
                                    $sql="SELECT * FROM categories WHERE  id_user = 0 OR id_user like '$user_id'";
                                    $res=$conn->query($sql);
                                    if($res->num_rows > 0){
                                        while($row = $res->fetch_assoc()) {
                                            $cat_id=$row['id'];
                                            $descriz = $row['descriz'];
                                            if($descriz==$category){
                                                echo "<option value='$cat_id' selected>$descriz</option>";
                                            }else{
                                                echo "<option value='$cat_id'>$descriz</option>";
                                            }         
                                        }
                                    } 
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="folder">Folder</label>
                            <select id="folder" name="folder" class="form-control" data-error="Please specify the category">
                                <option value="-" selected ><?php echo $folder ?></option>
                                <?php
                                    $sql="SELECT * FROM folders WHERE id_user = '$user_id'";
                                    $res=$conn->query($sql);
                                    if($res->num_rows > 0){
                                        while($row = $res->fetch_assoc()) {
                                            $folder_id=$row['id'];
                                            $f_name = $row['name'];
                                            echo "<option value='$folder_id'>$f_name</option>";
                                        }
                                    }
                                    
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <a class="btn btn-primary profile-button" href="index.php">Cancel</a>
                            <button class="btn btn-primary profile-button" type="submit">Save</button>
                        </div>
          
                    </div>


                </div>
            </form>
        </div>
    </div>


    </div>
        <!-- /.8 -->

    </div>
    <!-- /.row-->

</div>
</div>

    </div>
       <!--implementare bootstrap-->
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>

