<?php
// Receive JSON payload
$callbackData = file_get_contents('php://input');
$response = json_decode($callbackData, true);

// Extract payment details
$ResultCode = $response['Body']['stkCallback']['ResultCode'] ?? null;
$ResultDesc = $response['Body']['stkCallback']['ResultDesc'] ?? null;
$Amount = $response['Body']['stkCallback']['CallbackMetadata']['Item'][0]['Value'] ?? null;
$MpesaReceiptNumber = $response['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'] ?? null;
$PhoneNumber = $response['Body']['stkCallback']['CallbackMetadata']['Item'][4]['Value'] ?? null;

// Prepare JSON data
$paymentData = [
    'ResultCode' => $ResultCode,
    'ResultDesc' => $ResultDesc,
    'Amount' => $Amount,
    'MpesaReceiptNumber' => $MpesaReceiptNumber,
    'PhoneNumber' => $PhoneNumber
];

// Write to JSON file
file_put_contents('payments.json', json_encode($paymentData, JSON_PRETTY_PRINT), FILE_APPEND);

// Log callback for debugging
error_log("STK Push Callback: " . json_encode($response));

// Database Connection (example using MySQL)
$db = new mysqli('localhost', 'username', 'password', 'database_name');
if ($db->connect_error) {
    error_log("Database connection failed: " . $db->connect_error);
    die(json_encode(['ResultCode' => 1, 'ResultDesc' => 'Database connection failed']));
}

// Insert into database
$stmt = $db->prepare("INSERT INTO payments (phone, amount, mpesa_receipt, result_code, result_desc) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $PhoneNumber, $Amount, $MpesaReceiptNumber, $ResultCode, $ResultDesc);

if ($stmt->execute()) {
    error_log("Payment saved to database successfully.");
} else {
    error_log("Failed to save payment: " . $stmt->error);
}

// Close database connection
$stmt->close();
$db->close();

// Send response to Safaricom
header("Content-Type: application/json");
echo json_encode(['ResultCode' => 0, 'ResultDesc' => 'Callback received successfully']);;
?>