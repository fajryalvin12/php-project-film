<?php

require __DIR__ . '/../config/db.php';
require __DIR__ . '/../functions/film.php';

$id = $_GET["id"];

if ( deleteFilm($conn, $id) > 0) {
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