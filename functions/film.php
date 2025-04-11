<?php
    require __DIR__ . '/check.php';
    require __DIR__ . '/logger.php';
    require __DIR__ . '/db.php';

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
        // sanitize the input value
        $title = trim($title);
        $author = trim($author);
        $year = trim($year);
        $genre = trim($genre);
        $id = intval($id);

        // filtering the input with proper logic
        $validator = validateInputData($title, $author, $year, $genre);
        if ($validator !== true) {
            logMessage("Validation Failed : $validator", "WARNING");
            return $validator;
        }

        $message = isFilmExist($conn, $id);
        if ($message !== true) {
            logMessage("Data not found : $message", "ERROR");
            return "Data not found : $message";
        }

        $message = updateFilm($conn, $title, $author, $year, $genre, $id);
        if ($message !== true) {
            logMessage("Failed to Update : $message ", "ERROR");
            return "Failed to Update : $message";
        }

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