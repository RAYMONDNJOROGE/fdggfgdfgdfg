<?php
$data = file_get_contents('php://input');
file_put_contents('mpesa_callback_log.json', $data . PHP_EOL, FILE_APPEND); // optional log

$callbackData = json_decode($data, true);

if (
    isset($callbackData['Body']['stkCallback']['ResultCode']) &&
    $callbackData['Body']['stkCallback']['ResultCode'] == 0
) {
    $meta = $callbackData['Body']['stkCallback']['CallbackMetadata']['Item'];

    $info = [
        'phone' => $meta[4]['Value'] ?? '',
        'amount' => $meta[0]['Value'] ?? '',
        'checkoutRequestID' => $callbackData['Body']['stkCallback']['CheckoutRequestID'],
        'timestamp' => date('Y-m-d H:i:s')
    ];

    file_put_contents('latest_payment.json', json_encode($info));
}
