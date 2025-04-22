<?php
header('Content-Type: application/json');

$filename = 'payments.json';

if (file_exists($filename)) {
    $json = file_get_contents($filename);
    $payments = json_decode($json, true);

    if (!empty($payments)) {
        $latest = end($payments); // Get the last payment
        echo json_encode([
            'phone' => $latest['phone'],
            'amount' => $latest['amount']
        ]);
        exit;
    }
}

echo json_encode([]);
?>
