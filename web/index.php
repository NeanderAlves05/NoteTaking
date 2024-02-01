<?php
include '../requires/session.php';
doLogin($logged_in);
include '../requires/connection.php';
include '../requires/cookie.php';

$id_user=$_COOKIE["id"];
$sql="SELECT count(*) FROM notes where id_user = '$id_user'";
$res=$conn->query($sql);
if ($res->num_rows !=0) {
  $n_notes=$res; //n sarà utilizzato per stampare le note sucessivamente
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['new_category']!=""){
  $new_category=$_POST['new_category'];
  $sql="INSERT INTO categories(descriz,id_user) VALUES ('$new_category','$id_user')";
  $res=$conn->query($sql);
  if(!$res){
    echo("ERRORE");
  }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>NoteTaking Home</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/album/">
    <link rel="stylesheet" type="text/css" href="../res/css/main.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
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
          <a class="nav-link active " aria-current="page" href="index.php">Home</a>
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
  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">New Note</h1>
        <p class="lead text-muted">Scrivi i tuoi pensieri e annotazioni </p>
        <div class="row">
          <div class="col-md-4">
              <a href="note.php" class="btn btn-primary my-2">Create a note</a>
          </div>
          <div class="col-md-4">
              <a href="index.php?action=folder"class="btn btn-primary my-2">Create a folder</a>
          </div>
          <!-- Button trigger modal -->
          <div class="col-md-4">
            <button type="button" class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#modalCategory">
              Create a category
            </button>
          </div>
          <!-- Modal -->
          <div class="modal fade" id="modalCategory" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <form action="index.php" method="post">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="modalLabel">Create a new category</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <input id="new_category" type="text" name="new_category" class="form-control" placeholder="Category" required="required" data-error="Please specify a name" value="">
                          </div>
                      </div>
                      <div class="col-md-6">
                      </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </div>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">
    <strong>Note List</strong>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
       <?php  
          $sql = "SELECT * FROM notes WHERE id_user like '$id_user'";
          $result = $conn->query($sql);
          if($result->num_rows>0){
            while($note = $result->fetch_assoc()) {
                // Estrai i dati dalla riga risultato
                $note_id= $note['id'];
                $id_user = $note['id_user'];
                $id_category = $note['id_category'];
                $title = $note['title'];
                $content = $note['content'];
                $last_update = $note['last_update'];
                // Puoi anche eseguire una seconda query per ottenere la categoria
                $category_sql = "SELECT descriz FROM categories WHERE id = $id_category";
                $category_result = $conn->query($category_sql);
                $category_row = $category_result->fetch_assoc();
                $category = $category_row['descriz'];
            ?>
              <div class="col">
                <div class="card shadow-sm">
                  <div class="card-body">
                    <p class="card-title"><?php echo $title?></p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                        <a class="btn btn-sm btn-outline-secondary" href="note.php?nId=<?php echo $note_id?>">Edit</a>
                        <a class="btn btn-sm btn-outline-secondary" onClick="deleteNote($conn,$note_id)">Delete</a>
                      </div>
                      <small class="text-muted"></small>
                    </div>
                  </div>
                </div>
              </div>
            <?php      
              }
            }
            ?>
          </div>
        </div>
      </div>

    </div>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
      
  </body>
</html>

<?php
  function deleteNote($conn, $noteId) {
    $deleteSql = "DELETE FROM notes WHERE id = $noteId";
    $result = $conn->query($deleteSql);

    if ($result) {
        // La nota è stata eliminata con successo
        return true;
    } else {
        // Errore durante l'eliminazione della nota
        return false;
    }
}
?>