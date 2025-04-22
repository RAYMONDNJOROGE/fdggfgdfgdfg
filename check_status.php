<?php
if (!isset($_POST['CheckoutRequestID'])) {
    echo json_encode(['ResultCode' => 1, 'message' => 'Missing CheckoutRequestID']);
    exit;
}

$checkoutID = $_POST['CheckoutRequestID'];
$filename = 'payments.json';

if (!file_exists($filename)) {
    echo json_encode(['ResultCode' => 2, 'message' => 'No payment data yet']);
    exit;
}

$payments = json_decode(file_get_contents($filename), true);

if (!isset($payments[$checkoutID])) {
    echo json_encode(['ResultCode' => 3, 'message' => 'Payment still pending']);
    exit;
}

// Return full payment object
echo json_encode($payments[$checkoutID]);
?>
