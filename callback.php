<?php
$callbackJSON = file_get_contents('php://input');
$callbackData = json_decode($callbackJSON, true);

$filename = 'payments.json';
$paymentDetails = [];

$resultCode = $callbackData['Body']['stkCallback']['ResultCode'];

if ($resultCode == 0) {
    $metadata = $callbackData['Body']['stkCallback']['CallbackMetadata']['Item'];

    $amount = 0;
    $phone = '';
    
    foreach ($metadata as $item) {
        if ($item['Name'] == 'Amount') {
            $amount = $item['Value'];
        }
        if ($item['Name'] == 'PhoneNumber') {
            $phone = $item['Value'];
        }
    }

    $paymentDetails = [
        'phone' => $phone,
        'amount' => $amount,
        'timestamp' => date('Y-m-d H:i:s')
    ];

    // Save to file
    $existingPayments = file_exists($filename) ? json_decode(file_get_contents($filename), true) : [];
    $existingPayments[] = $paymentDetails;
    file_put_contents($filename, json_encode($existingPayments, JSON_PRETTY_PRINT));
}
?>
