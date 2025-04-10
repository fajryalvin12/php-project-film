<?php
    function validateInputData ($title, $author, $year, $genre) {
        if (empty($title) || empty($author) || empty($year) || empty($genre)) {
            return "Please input the data first";
        } 
        if (strlen($title) > 80 || strlen($author) > 80 || strlen($year) > 4 || strlen($genre) > 15) {
            return "Too much character in the input, please input shorter.";
        } 
        if (!preg_match('/^[a-zA-Z0-9\s\.\,\-]+$/', $title)) {
            return "Please input valid characters";
        } 
        if (!filter_var($year, FILTER_VALIDATE_INT)) {
            return "Please input the proper numbers in year column";
        } 
        if ( $year < 1800 || $year > 2025) {
            return "Please input the proper year's range";
        }

     return true;
     
    }

?>