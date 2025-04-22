<?php
header('Content-Type: application/json');

// File where callback stores payment info
$filename = 'payments.json';

if (file_exists($filename)) {
    $json = file_get_contents($filename);
    $payments = json_decode($json, true);

    // Get the most recent payment if available
    if (!empty($payments)) {
        $latest = end($payments); // Last payment
        echo json_encode([
            'phone' => $latest['phone'],
            'amount' => $latest['amount']
        ]);
        exit;
    }
}

// If nothing found
echo json_encode([]);
?>
