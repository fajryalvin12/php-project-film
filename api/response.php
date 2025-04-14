<?php

    function sendJson ($statusCode, $data) {
        http_response_code($statusCode);
        return json_encode($data);     
    }
    
    function responseSuccess($message, $data = []) {
        return [
            "status" => 200,
            "message" => $message,
            "data" => $data
        ];
    }

    function responseError($message) {
        return [
            "status" => 400,
            "message" => $message,
        ];
    }

    function responseBadRequest($message) {
        return [
            "status" => 400,
            "message" => $message,
        ]; 
    }
?>