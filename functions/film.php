<?php
    function getAllFilm ($conn, $query) {
        $result = mysqli_query($conn, $query);
        
        $rows = [];
        while ( $row = mysqli_fetch_assoc($result) ) {
            $rows[] = $row;
        }
        return $rows;
    }        
    function addFilm($conn, $title, $author, $year, $genre) {

        if (empty($title) || empty($author) || empty($year) || empty($genre)) {
            $message = "Please input the data first";
        } else {
            $sql = "INSERT INTO movies (title, author, year, genre) VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $title, $author, $year, $genre);
            
            if($stmt->execute()) {
                $message = "Success to add new film";
            } else {
                $message = "Error" . $stmt->error;
            }
            $stmt->close();
        }
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