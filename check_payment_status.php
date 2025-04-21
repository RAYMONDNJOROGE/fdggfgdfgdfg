<?php
// check_payment_status.php (dummy logic)
$checkoutRequestID = $_POST['checkoutRequestID'] ?? '';

$data = file_get_contents('stk_callback_log.json');

// Find matching record (simplified search)
$entries = explode("\n\n", $data);
foreach ($entries as $entry) {
    if (strpos($entry, $checkoutRequestID) !== false) {
        $decoded = json_decode($entry, true);
        $resultCode = $decoded['Body']['stkCallback']['ResultCode'];
        $status = $resultCode === 0 ? 'success' : 'failed';
        echo json_encode(['paymentStatus' => $status]);
        exit;
    }
}

echo json_encode(['paymentStatus' => 'pending']);
