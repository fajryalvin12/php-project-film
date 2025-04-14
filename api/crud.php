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
        $response = sendJson(200, responseSuccess("List all film", $movies));
        echo $response;

    } else if ($method === "POST") {
        $data = getData();
        $title = trim($data["title"]);
        $author = trim($data["author"]);
        $year = trim($data["year"]);
        $genre = trim($data["genre"]);

        $sql = "INSERT INTO movies (title, author, year, genre) VALUES (?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssis", $title, $author, $year, $genre);

        if ($stmt->execute()) {
            $message = "Success add new movie";
            $response = responseSuccess($message, [
                "id" => $conn->insert_id, 
                "title" => $title,
                "author" => $author,
                "year" => $year,
                "genre" => $genre,
                ]
            );
            echo sendJson(201, $response);
        } else {
            $message = "Failed to add new movie";
            $response = responseError($message);
            echo sendJson(400, $response);
        }
        $stmt->close();
    } else if ($method === "PUT") {
        $data = getData();
        $id = $data["id"];
        $title = trim($data["title"]);
        $author = trim($data["author"]);
        $year = trim($data["year"]);
        $genre = trim($data["genre"]);

        $sql = "UPDATE movies SET title=?, author=?, year=?, genre=? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssisi", $title, $author, $year, $genre, $id);

        if ($stmt->execute()){
            $message = "Success edit the movie with id = $id";
            $response = responseSuccess($message, [
                "id" => $id, 
                "title" => $title,
                "author" => $author,
                "year" => $year,
                "genre" => $genre,
                ]
            );
            echo sendJson(202, $response);
        } else {
            $message = "Failed to update the movie";
            $response = responseError($message);
            echo sendJson(400, $response);
        }

        $stmt->close();

    } else if ($method === "DELETE") {
        $data = getData();
        
        if (!isset($data["id"])) {
            echo sendJson(400, responseError("Input ID required!"));
            exit;
        };
        
        $id = $data["id"];

        $sql = "DELETE FROM movies WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $message = "Success delete the movie with id = $id";
            $response = responseSuccess($message, ["id" => $id]);
            echo sendJson(202, $response);
        } else {
            $message = "Failed to delete the movie";
            $response = responseError($message);
            echo sendJson(400, $response); 
        }

        $stmt->close();
    } else {
        http_response_code(405);
        echo json_encode("Message: Tidak diizinkan");
    }
?>