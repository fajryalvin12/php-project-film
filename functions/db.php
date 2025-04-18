<?php

    // roled as models, or repositories

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
    function insertFilm($conn, $title, $author, $year, $genre) {
        $sql = "INSERT INTO movies (title, author, year, genre) VALUES (?,?,?,?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            $message = "Error : " . $conn->error;
            logMessage($message, "ERROR");
            return $message;
        }
        $stmt->bind_param("ssds", $title, $author, $year, $genre);
        
        if($stmt->execute()) {
            $message = "Success to add new film";
            logMessage($message, "INFO");
            $stmt->close();
            return true; 
        } else {
            $message = "Error" . $stmt->error;
            logMessage($message, "ERROR");
            $stmt->close();
            return $message; 
        }
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
    function deleteFilm($conn, $id) {
        $sql = "DELETE FROM movies WHERE id=?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            $message = "Error : " . $conn->error;
            logMessage($message, "ERROR");
            return $message;
        }
        
        $stmt->bind_param("i", $id);

        if($stmt->execute()) {
            $message = "Success to delete the film";
            logMessage($message, "INFO");
            $stmt->close();
            return true;
        } else {
            $message = "Error : " . $stmt->error;
            logMessage($message, "ERROR");
            $stmt->close();
            return $message;
        }
    }
?>