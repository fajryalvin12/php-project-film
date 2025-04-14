<?php
    function responseSuccess($message, $data = []) {
        return [
            "status" => 200,
            "message" => $message,
            "data" => $data
        ];
    }

    function responseBadRequest($message) {
        return [
            "status" => 400,
            "message" => $message,
        ]; 
    }
?>