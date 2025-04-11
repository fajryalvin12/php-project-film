<?php
    require __DIR__ . '/check.php';
    require __DIR__ . '/logger.php';
    require __DIR__ . '/db.php';

    // roled as controllers

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

        // filtering the input with proper logic or middleware
        $validator = validateInputData($title, $author, $year, $genre);
        if ($validator !== true) {
            logMessage("Validation Failed : $validator", "WARNING");
            return $validator;
        }

        // add new input value
        $message = insertFilm($conn, $title, $author, $year, $genre);
        if ($message !== true) {
            logMessage("Failed to Insert : $message ", "ERROR");
            return "Failed to Insert : $message";
        }

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

        // check the choosen film is existed or not
        $message = isFilmExist($conn, $id);
        if ($message !== true) {
            logMessage("Data not found : $message", "ERROR");
            return "Data not found : $message";
        }

        // updated the selected movies or film
        $message = updateFilm($conn, $title, $author, $year, $genre, $id);
        if ($message !== true) {
            logMessage("Failed to Update : $message ", "ERROR");
            return "Failed to Update : $message";
        }

        return $message;
    }
    function removeFilm($conn, $id) {
        $id = intval(trim($id));
        if ($id === "") {
            $message = "Id not found";
            logMessage("Error : $message", "WARNING");
            return "Error : $message";
        }

        $message = isFilmExist($conn, $id);
        if ($message !== true) {
            logMessage("Data not found : $message", "ERROR");
            return "Data not found : $message";
        }

        $message = deleteFilm($conn, $id);
        if ($message !== true) {
            logMessage("Failed to Delete : $message ", "ERROR");
            return "Failed to Delete : $message";
        }

        return $message;
    }
?>