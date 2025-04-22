<?php
date_default_timezone_set('Africa/Nairobi');

$callbackJSON = file_get_contents('php://input');
file_put_contents("callback_raw.json", $callbackJSON); // Optional: raw log

$callbackData = json_decode($callbackJSON, true);

$filename = 'payments.json';
$paymentDetails = [];

if (isset($callbackData['Body']['stkCallback']['ResultCode'])) {
    $resultCode = $callbackData['Body']['stkCallback']['ResultCode'];

    if ($resultCode == 0) {
        $metadata = $callbackData['Body']['stkCallback']['CallbackMetadata']['Item'];

        $amount = 0;
        $phone = '';
        $mpesaReceipt = '';
        $checkoutRequestID = $callbackData['Body']['stkCallback']['CheckoutRequestID'] ?? '';

        foreach ($metadata as $item) {
            if ($item['Name'] === 'Amount') {
                $amount = $item['Value'];
            } elseif ($item['Name'] === 'PhoneNumber') {
                $phone = $item['Value'];
            } elseif ($item['Name'] === 'MpesaReceiptNumber') {
                $mpesaReceipt = $item['Value'];
            }
        }

        $paymentDetails = [
            'phone' => $phone,
            'amount' => $amount,
            'mpesa_receipt' => $mpesaReceipt,
            'CheckoutRequestID' => $checkoutRequestID,
            'timestamp' => date('Y-m-d H:i:s')
        ];

        // Save successful payment to file
        $existingPayments = file_exists($filename)
            ? json_decode(file_get_contents($filename), true)
            : [];

        $existingPayments[] = $paymentDetails;
        file_put_contents($filename, json_encode($existingPayments, JSON_PRETTY_PRINT));
    }
}
?>
