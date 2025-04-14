<?php
    function getData() {
        $input = file_get_contents("php://input");
        $data = json_decode($input, true);
    
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($data)) {
            return [];
        }
    
        return $data;
    }
    
?>