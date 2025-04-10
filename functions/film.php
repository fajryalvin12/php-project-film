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
        
        $sql = "INSERT INTO movies (title, author, year, genre) VALUES (?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $title, $author, $year, $genre);
        
        if($stmt->execute()) {
            $message = "Berhasil ditambahkan";
        } else {
            $message = "Error" . $stmt->error;
        }
        $stmt->close();
        return $message;
    }
?>