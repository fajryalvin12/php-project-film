<?php

    require __DIR__ . '/config/db.php';
    require __DIR__ . '/functions/film.php';

    $movies = getAllFilm($conn, "SELECT * FROM movies")
    // $movies = [
    //     [
    //         "title" => "Kungfu Hustle",
    //         "author" => "Stephen Chow",
    //         "year" => "2004",
    //         "genre" => "Action",
    //     ],
    //     [
    //         "title" => "The Conjuring",
    //         "author" => "James Wan",
    //         "year" => "2013",
    //         "genre" => "Horror"
    //     ],
    //     [
    //         "title" => "Avengers : Endgame",
    //         "author" => "Anthony Russo",
    //         "year" => "2019",
    //         "genre" => "Sci-Fi"
    //     ],
    // ]
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

    <a href="../projectphp/pages/add.php">Add the list film</a>
    <br></br>

    <table>
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Author</th>
            <th>Year</th>
            <th>Genre</th>
        </tr>
        <?php $id = 1 ?>
        <?php foreach ($movies as $movie) : ?>
        <tr>
            <td><?= $id ?></td>
            <td><?= $movie["title"] ?></td>
            <td><?= $movie["author"] ?></td>
            <td><?= $movie["year"] ?></td>
            <td><?= $movie["genre"] ?></td>
        </tr>
        <?php $id++ ?>
        <?php endforeach ?>
    </table>
</body>
</html>