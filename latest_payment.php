<?php
header('Content-Type: application/json');

// File where callback.php stores successful payments
$filename = 'payments.json';

if (file_exists($filename)) {
    $json = file_get_contents($filename);
    $payments = json_decode($json, true);

    // Return latest payment if available
    if (!empty($payments)) {
        $latest = end($payments); // Get the last entry
        echo json_encode([
            'phone' => $latest['phone'],
            'amount' => $latest['amount'],
            'timestamp' => $latest['timestamp']
        ]);
        exit;
    }
}

// No payment yet
echo json_encode([]);
?>
