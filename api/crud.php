<?php
    require "../config/db.php";
    require "./functions.php";
    require "./response.php";

    header("Content-Type: application/json");
    
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === "GET") {
        $result = $conn->query("SELECT * FROM movies");

        $movies = [];
        while ($row = $result->fetch_assoc()) {
            $movies[] = $row;
        }
        http_response_code(200);
        echo json_encode(responseSuccess("List all film", $movies));

    } else if ($method === "POST") {
        $data = getData();
        $title = $conn->real_escape_string($data["title"]);
        $author = $conn->real_escape_string($data["author"]);
        $year = $conn->real_escape_string($data["year"]);
        $genre = $conn->real_escape_string($data["genre"]);

        $query = $conn->query("INSERT INTO movies (title, author, year, genre) VALUES ('$title', '$author', '$year', '$genre')");
        if ($query) {
            http_response_code(201);
            echo json_encode(responseSuccess("Success add new movie", 
            [
                "id" => $conn->insert_id, 
                "title" => $title,
                "author" => $author,
                "year" => $year,
                "genre" => $genre,
            ]
        ));
        } else {
            http_response_code(400);
            echo json_encode(responseBadRequest("Failed to add new movie"));
        }
    } else if ($method === "PUT") {
        $data = getData();
        $id = $data["id"];
        $title = $conn->real_escape_string($data["title"]);
        $author = $conn->real_escape_string($data["author"]);
        $year = $conn->real_escape_string($data["year"]);
        $genre = $conn->real_escape_string($data["genre"]);

        $query = $conn->query("UPDATE movies SET title='$title', author='$author', year='$year', genre='$genre' WHERE id = $id");

        if ($query) {
            echo json_encode(["message" => "The movies with id : $id was updated"]);
        } else {
            echo json_encode(["message" => "Failed to updated the movies"]);
        }
    } else if ($method === "DELETE") {
        $data = getData();
        $id = $data["id"];
        $query = $conn->query("DELETE FROM movies WHERE id = $id");
        if ($query) {
            echo json_encode(["message" => "The movies with id : $id was deleted"]);
        } else {
            echo json_encode(["message" => "Failed to deleted the movies"]);
        }
    } else {
        http_response_code(405);
        echo json_encode("Message: Tidak diizinkan");
    }
?>