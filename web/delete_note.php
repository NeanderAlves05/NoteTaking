<?php
include '../requires/connection.php';
$note_id = $_GET['nId'];
// Query per eliminare i record dalla tabella note_folder
$delete_note_folder_query = "DELETE FROM note_folder WHERE id_note = '$note_id'";
if ($conn->query($delete_note_folder_query) === TRUE) {
    $deleteSql = "DELETE FROM notes WHERE notes.id = $note_id";
    $result = $conn->query($deleteSql);
    if ($result) {
        // La nota è stata eliminata con successo
        header("Location: index.php");
    } else {
        // Errore durante l'eliminazione della nota
        echo "ERRORE NELLA CANCELLAZIONE";
    }
}
?>