<?php
header('Content-Type: application/json');

$checkoutRequestID = $_POST['checkoutRequestID'] ?? null;
$filename = 'payments.json';

if ($checkoutRequestID && file_exists($filename)) {
    $payments = json_decode(file_get_contents($filename), true);

    if (isset($payments[$checkoutRequestID])) {
        echo json_encode([
            'paymentStatus' => 'success',
            'phone' => $payments[$checkoutRequestID]['phone'],
            'amount' => $payments[$checkoutRequestID]['amount']
        ]);
        exit;
    }
}

echo json_encode(['paymentStatus' => 'pending']);
?>
