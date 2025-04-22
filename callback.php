<?php
// Receive the JSON payload
$callbackData = file_get_contents('php://input');
$response = json_decode($callbackData, true);

// Log the callback data
error_log("Callback received: " . json_encode($response));

// Extract payment details
$ResultCode = $response['Body']['stkCallback']['ResultCode'] ?? null;
$ResultDesc = $response['Body']['stkCallback']['ResultDesc'] ?? null;
$CheckoutRequestID = $response['Body']['stkCallback']['CheckoutRequestID'] ?? null;
$Amount = $response['Body']['stkCallback']['CallbackMetadata']['Item'][0]['Value'] ?? null;
$MpesaReceiptNumber = $response['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'] ?? null;
$PhoneNumber = $response['Body']['stkCallback']['CallbackMetadata']['Item'][4]['Value'] ?? null;

// Log payment details
error_log("Payment Status:");
error_log("Result Code: " . ($ResultCode === "0" ? "Success ✅" : "Failed ❌"));
error_log("Description: " . $ResultDesc);
error_log("Checkout Request ID: " . $CheckoutRequestID);
error_log("Amount: " . $Amount);
error_log("Mpesa Receipt Number: " . $MpesaReceiptNumber);
error_log("Phone Number: " . $PhoneNumber);

// Send response to Safaricom
header("Content-Type: application/json");
echo json_encode(['ResultCode' => 0, 'ResultDesc' => 'Callback received successfully']);
?>