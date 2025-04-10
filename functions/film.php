<?php
    require __DIR__ . '/check.php';
    require __DIR__ . '/logger.php';

    function getAllFilm ($conn, $query) {
        $result = mysqli_query($conn, $query);
        
        $rows = [];
        while ( $row = mysqli_fetch_assoc($result) ) {
            $rows[] = $row;
        }
        return $rows;
    }        
    function addFilm($conn, $title, $author, $year, $genre) {
        // sanitize the input value
        $title = trim($title);
        $author = trim($author);
        $year = trim($year);
        $genre = trim($genre);

        // filtering the input with proper logic
        $validator = validateInputData($title, $author, $year, $genre);
        if ($validator !== true) {
            logMessage("Validation Failed : $validator", "WARNING");
            return $validator;
        }

        $sql = "INSERT INTO movies (title, author, year, genre) VALUES (?,?,?,?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            $message = "Error : " . $conn->error; 
        }
        $stmt->bind_param("ssds", $title, $author, $year, $genre);
        
        if($stmt->execute()) {
            $message = "Success to add new film";
        } else {
            $message = "Error" . $stmt->error;
        }
        $stmt->close();
        return $message;
    }
    function editFilm($conn, $title, $author, $year, $genre, $id) {
        $sql = "UPDATE movies SET title=?, author=?, year=?, genre=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssd", $title, $author, $year, $genre, $id);

        if($stmt->execute()) {
            $message = "Success to edit the film";
        } else {
            $message = "Error" . $stmt->error;
        }

        $stmt->close();
        return $message;
    }
    function deleteFilm($conn, $id) {
        $sql = "DELETE FROM movies WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if($stmt->execute()) {
            $message = "Success to delete the film";
        } else {
            $message = "Error" . $stmt->error;
        }

        $stmt->close();
        return $message;
    }
?>