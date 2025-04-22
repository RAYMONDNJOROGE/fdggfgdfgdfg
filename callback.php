<?php
$callbackJSON = file_get_contents('php://input');
$callbackData = json_decode($callbackJSON, true);

$filename = 'payments.json';
$paymentDetails = [];

file_put_contents('logs.json', json_encode($callbackData, JSON_PRETTY_PRINT)); // for debugging

$resultCode = $callbackData['Body']['stkCallback']['ResultCode'];
$checkoutID = $callbackData['Body']['stkCallback']['CheckoutRequestID'];

if ($resultCode == 0) {
    $metadata = $callbackData['Body']['stkCallback']['CallbackMetadata']['Item'];
    $amount = 0;
    $phone = '';

    foreach ($metadata as $item) {
        if ($item['Name'] == 'Amount') $amount = $item['Value'];
        if ($item['Name'] == 'PhoneNumber') $phone = $item['Value'];
    }

    $paymentDetails = [
        'CheckoutRequestID' => $checkoutID,
        'ResultCode' => 0,
        'amount' => $amount,
        'phone' => $phone,
        'timestamp' => date('Y-m-d H:i:s')
    ];

    // Optionally send to DB
    include 'save_to_db.php';
} else {
    $paymentDetails = [
        'CheckoutRequestID' => $checkoutID,
        'ResultCode' => $resultCode,
        'timestamp' => date('Y-m-d H:i:s')
    ];
}

// Save to file
$existing = file_exists($filename) ? json_decode(file_get_contents($filename), true) : [];
$existing[$checkoutID] = $paymentDetails;
file_put_contents($filename, json_encode($existing, JSON_PRETTY_PRINT));

// Respond to Safaricom
echo json_encode(["ResultCode" => 0, "ResultDesc" => "Callback received successfully"]);
?>
