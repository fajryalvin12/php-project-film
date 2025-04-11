<?php

    require __DIR__ . '/../config/db.php';
    require __DIR__ . '/../functions/film.php';

    $message = "";

    $id = $_GET["id"];
    $movies = getAllFilm($conn, "SELECT * FROM movies WHERE id = $id")[0];

    if (isset($_POST["edit"])) {
        $result = editFilm($conn, $_POST["title"], $_POST["author"], $_POST["year"], $_POST["genre"], $id);
        $message = $result === true ? "Success to Edit the Film" : $result;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Film</title>
    <style></style>
</head>
<body>
    <h1>Edit the film</h1>

    <p style="color: red;"><?= $message ?></p>

    <form action="" method="post">
        <li>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="<?= $movies["title"] ?>">
        </li> 
        <li>
            <label for="author">Author</label>
            <input type="text" name="author" id="author" value="<?= $movies["author"] ?>">
        </li> 
        <li>
            <label for="year">Year</label>
            <input type="text" name="year" id="year" value="<?= $movies["year"] ?>">
        </li> 
        <li>
            <label for="genre">Genre</label>
            <input type="text" name="genre" id="genre" value="<?= $movies["genre"] ?>">
        </li>
        <li>
            <button type="submit" name="edit">Edit!</button>
        </li>
    </form>

    <a href="../index.php">Back to main menu</a>
</body>
</html>