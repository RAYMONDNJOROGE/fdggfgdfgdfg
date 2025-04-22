<?php
header('Content-Type: application/json');

// Path to the file that stores payment info
$filename = 'payments.json';

if (file_exists($filename)) {
    $json = file_get_contents($filename);
    $payments = json_decode($json, true);

    // Ensure data is valid and non-empty array
    if (is_array($payments) && !empty($payments)) {
        $latest = end($payments); // Get the last payment
        echo json_encode([
            'phone' => $latest['phone'] ?? null,
            'amount' => $latest['amount'] ?? null
        ]);
        exit;
    }
}

// Nothing found or file missing
echo json_encode([]);
exit;
?>
