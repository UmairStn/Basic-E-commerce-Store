<?php
<?php
function logError($message, $severity = 'ERROR') {
    $logFile = __DIR__ . '/../logs/error.log';
    $timestamp = date('Y-m-d H:i:s');
    $logMessage = "[$timestamp] $severity: $message\n";
    error_log($logMessage, 3, $logFile);
}

function displayError($message) {
    return "An error occurred. Please try again later.";
}
?>