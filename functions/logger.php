<?php
    function logMessage ($message, $level = "INFO") {
        $logDir = __DIR__ . "/../logs";
        $logFile = $logDir . "/app.log";

        $date = date("Y-m-d H:i:s");
        $formattedMessage = "[$date] [$level] $message . PHP_EOL";

        file_put_contents($logFile, $formattedMessage, FILE_APPEND);
    }
?>