<?php

require __DIR__ . '/../config/db.php';
require __DIR__ . '/../functions/film.php';

$id = $_GET["id"];
if (!isset($id) || !filter_var($id, FILTER_VALIDATE_INT)) {
    $message = "Invalid ID data";
    logMessage("Error : $message", "ERROR");
    exit;
} 

$result = removeFilm($conn, $id); 
if ( $result === true ) {
    echo "
    <script>
        alert('data berhasil dihapus!');
        document.location.href = '../index.php';
    </script>
    ";
} else {
    echo "
    <script>
        alert('data gagal dihapus!');
        document.location.href = '../index.php';
    </script>
    ";
}

?>