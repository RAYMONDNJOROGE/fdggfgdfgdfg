<?php
// callback.php

$data = file_get_contents("php://input");
$log = fopen("stk_callback_log.json", "a+");
fwrite($log, $data . "\n\n");
fclose($log);

// Decode the incoming JSON
$decoded = json_decode($data, true);

// Extract data for console (example)
if (isset($decoded['Body']['stkCallback'])) {
    $callback = $decoded['Body']['stkCallback'];

    $resultCode = $callback['ResultCode'];
    $resultDesc = $callback['ResultDesc'];
    $receipt = 'N/A';
    $amount = 'N/A';

    if (isset($callback['CallbackMetadata']['Item'])) {
        foreach ($callback['CallbackMetadata']['Item'] as $item) {
            if ($item['Name'] == 'MpesaReceiptNumber') {
                $receipt = $item['Value'];
            }
            if ($item['Name'] == 'Amount') {
                $amount = $item['Value'];
            }
        }
    }

    // Store or respond with it (for now, just respond back)
    echo json_encode([
        'paymentStatus' => $resultCode == 0 ? 'success' : 'failed',
        'resultDesc' => $resultDesc,
        'receipt' => $receipt,
        'amount' => $amount
    ]);
} else {
    echo json_encode(['error' => 'Invalid callback format']);
}