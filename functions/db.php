<?php

    function isFilmExist($conn, $id) {
        $sqlCheckId = "SELECT * FROM movies WHERE id = ?";
        $stmt = $conn->prepare($sqlCheckId);
        if (!$stmt) {
            logMessage("SQL Prepared Error : $conn->error", "ERROR");
            return $conn->error;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 0) {
            logMessage("Edit failed : film with ID : $id not found", "WARNING");
            return "film with ID : $id not found";
        }
        $stmt->close();
        return true;
    }
    function updateFilm($conn, $title, $author, $year, $genre, $id) {
        $sqlUpdate = "UPDATE movies SET title=?, author=?, year=?, genre=? WHERE id=?";
        $stmt = $conn->prepare($sqlUpdate);

        if (!$stmt) {
            logMessage("SQL Prepared Error : $conn->error", "ERROR");
            return $conn->error;
        }

        $stmt->bind_param("ssisi", $title, $author, $year, $genre, $id);

        if($stmt->execute()) {
            $message = "Success to edit the film";
            logMessage($message, "INFO");
            $stmt->close();
            return true;    
        } else {
            $message = "Failed to execute" . $stmt->error;
            logMessage($message, "ERROR");
            $stmt->close();
            return $message;    
        }
    }
?>