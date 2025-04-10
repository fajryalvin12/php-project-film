<?php

    require __DIR__ . '/config/db.php';
    require __DIR__ . '/functions/film.php';

    $movies = getAllFilm($conn, "SELECT * FROM movies");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
            display: block;
        }
        th, td {
            border: 1px solid black;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>

</head>
<body>

    <h1>Dashboard Page</h1>

    <a href="pages/add.php">Add the list film</a>
    <br></br>

    <table>
        <tr>
            <th>No</th>
            <th>Action</th>
            <th>Title</th>
            <th>Author</th>
            <th>Year</th>
            <th>Genre</th>
        </tr>
        <?php $num = 1 ?>
        <?php foreach ($movies as $movie) : ?>
        <tr>
            <td><?= $num ?></td>
            <td>
                <a href="pages/edit.php?id=<?= $movie["id"] ?>">Edit</a>
                <a href="pages/delete.php?id=<?= $movie["id"] ?>" onclick="return confirm('Are You Sure?')">Delete</a>
            </td>
            <td><?= $movie["title"] ?></td>
            <td><?= $movie["author"] ?></td>
            <td><?= $movie["year"] ?></td>
            <td><?= $movie["genre"] ?></td>
        </tr>
        <?php $num++ ?>
        <?php endforeach ?>
    </table>

</body>
</html>