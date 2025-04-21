<?php
// Read the latest logged successful payment
$logFile = "payment_success_log.json";
$logs = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$latest = end($logs);

header('Content-Type: application/json');
echo $latest ?: json_encode(["message" => "No payment found"]);
