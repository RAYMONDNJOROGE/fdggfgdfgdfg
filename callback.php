<?php
// Get incoming JSON from Safaricom
$data = file_get_contents("php://input");
file_put_contents("stk_response.json", $data); // Optional: save raw input for debugging

$response = json_decode($data, true);

// Ensure response has stkCallback
if (isset($response['Body']['stkCallback'])) {
    $callback = $response['Body']['stkCallback'];
    $resultCode = $callback['ResultCode'];
    $resultDesc = $callback['ResultDesc'];

    if ($resultCode == 0) {
        // Success
        $metadata = $callback['CallbackMetadata']['Item'];
        $amount = $metadata[0]['Value'];
        $mpesaCode = $metadata[1]['Value'];
        $phone = $metadata[4]['Value'];

        // Save to file or database
        file_put_contents("successful.txt", "$mpesaCode | $amount | $phone\n", FILE_APPEND);
    } else {
        // Failed or Cancelled
        file_put_contents("failed.txt", "$resultCode - $resultDesc\n", FILE_APPEND);
    }
}

http_response_code(200); // Always respond with 200 OK to avoid retry
?>
