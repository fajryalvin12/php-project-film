<?php

    require __DIR__ . '/../config/db.php';
    require __DIR__ . '/../functions/film.php';

    $message = "";

    if (isset($_POST["add"])) {
        $result = addFilm($conn, $_POST["title"], $_POST["author"], $_POST["year"], $_POST["genre"]);
        $message = $result === true ? "Success to add new film" : $result;
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Film</title>
    <style></style>
</head>
<body>
    <h1>Add new film</h1>

    <p style="color: red;"><?= htmlspecialchars($message) ?></p>

    <form action="" method="post">
        <li>
            <label for="title">Title</label>
            <input type="text" name="title" id="title">
        </li> 
        <li>
            <label for="author">Author</label>
            <input type="text" name="author" id="author">
        </li> 
        <li>
            <label for="year">Year</label>
            <input type="number" name="year" id="year">
        </li> 
        <li>
            <label for="genre">Genre</label>
            <input type="text" name="genre" id="genre">
        </li>
        <li>
            <button type="submit" name="add">Add!</button>
        </li>
    </form>

    <a href="../index.php">Back to Main Menu</a>
</body>
</html>