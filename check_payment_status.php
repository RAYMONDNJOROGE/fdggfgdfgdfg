<?php
$checkoutRequestID = $_POST['checkoutRequestID'] ?? '';

$data = file_get_contents('stk_callback_log.json');
$entries = explode("\n\n", $data);

foreach ($entries as $entry) {
    if (strpos($entry, $checkoutRequestID) !== false) {
        $json = json_decode($entry, true);
        $callback = $json['Body']['stkCallback'];

        $status = $callback['ResultCode'] == 0 ? 'success' : 'failed';
        echo json_encode(['paymentStatus' => $status]);
        exit;
    }
}

echo json_encode(['paymentStatus' => 'pending']);
