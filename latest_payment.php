<?php
header('Content-Type: application/json');

// Path to where payments are stored from the callback
$filename = 'payments.json';

if (file_exists($filename)) {
    $json = file_get_contents($filename);
    $payments = json_decode($json, true);

    if (!empty($payments)) {
        $latest = end($payments); // Get the latest payment entry
        echo json_encode([
            'phone' => $latest['phone'] ?? null,
            'amount' => $latest['amount'] ?? null,
            'timestamp' => $latest['timestamp'] ?? null
        ]);
        exit;
    }
}

// Default response if no payments found
echo json_encode([]);
?>
