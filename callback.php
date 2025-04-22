<?php
$callbackJSON = file_get_contents('php://input');
$callbackData = json_decode($callbackJSON, true);
$filename = 'payments.json';

if (isset($callbackData['Body']['stkCallback'])) {
    $stkCallback = $callbackData['Body']['stkCallback'];
    $resultCode = $stkCallback['ResultCode'];
    $checkoutRequestID = $stkCallback['CheckoutRequestID'];

    if ($resultCode == 0) {
        $metadata = $stkCallback['CallbackMetadata']['Item'];
        $paymentDetails = [
            'CheckoutRequestID' => $checkoutRequestID,
            'ResultCode' => $resultCode,
            'ResultDesc' => $stkCallback['ResultDesc'],
            'timestamp' => date('Y-m-d H:i:s')
        ];

        foreach ($metadata as $item) {
            if ($item['Name'] == 'Amount') {
                $paymentDetails['amount'] = $item['Value'];
            } elseif ($item['Name'] == 'PhoneNumber') {
                $paymentDetails['phone'] = $item['Value'];
            }
        }

        $payments = file_exists($filename) ? json_decode(file_get_contents($filename), true) : [];
        $payments[$checkoutRequestID] = $paymentDetails;

        file_put_contents($filename, json_encode($payments, JSON_PRETTY_PRINT));
    }
}
?>
