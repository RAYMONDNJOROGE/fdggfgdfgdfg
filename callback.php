<?php
// Get the raw POST data from Safaricom
$data = file_get_contents("php://input");

// Optional: Save the raw input to a file for logging/debugging
file_put_contents("stk_response.json", $data);

// Convert JSON to associative array
$response = json_decode($data, true);

// Check if it's a valid STK Callback
if (isset($response['Body']['stkCallback'])) {
    $callback = $response['Body']['stkCallback'];
    $resultCode = $callback['ResultCode'];
    $resultDesc = $callback['ResultDesc'];

    if ($resultCode == 0) {
        // Payment was successful
        $metadata = $callback['CallbackMetadata']['Item'];

        // Extract useful data
        $amount = $metadata[0]['Value'];
        $mpesaCode = $metadata[1]['Value'];
        $transactionDate = $metadata[3]['Value'];
        $phoneNumber = $metadata[4]['Value'];

        // Example: Save to a text file (you can insert into a database instead)
        $log = "SUCCESS | MPESA CODE: $mpesaCode | Amount: $amount | Phone: $phoneNumber | Date: $transactionDate\n";
        file_put_contents("payments_success.txt", $log, FILE_APPEND);
    } else {
        // Payment failed or was cancelled
        $log = "FAILED | Code: $resultCode | Desc: $resultDesc\n";
        file_put_contents("payments_failed.txt", $log, FILE_APPEND);
    }
}

http_response_code(200); // Always respond with 200 OK
?>
