<?php
header('Content-Type: application/json');
date_default_timezone_set('Africa/Nairobi');

// Safaricom sandbox credentials
$consumerKey       = '1bvBpyAQdFgnAxVgrPOoE0wNlnqdgqmTGw2ifirVgeG0gscJ';
$consumerSecret    = 'hu1EnuMQO4asAmvwqRn65c5OZwDqTnYAz9hA5NQaL0GopQQOAkuJjRhGWFtOAiak';
$BusinessShortCode = '174379';
$Passkey           = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';

// 1) Read the CheckoutRequestID from the request
$checkoutID = $_POST['CheckoutRequestID'] ?? '';
if (!$checkoutID) {
    echo json_encode(['error' => 'Missing CheckoutRequestID']);
    exit;
}

// 2) Fetch an OAuth token
$tokenUrl = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
$ch = curl_init($tokenUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, "$consumerKey:$consumerSecret");
$tokenResp = curl_exec($ch);
curl_close($ch);

$tokenData   = json_decode($tokenResp, true);
$accessToken = $tokenData['access_token'] ?? null;
if (!$accessToken) {
    echo json_encode(['error' => 'Failed to get access token']);
    exit;
}

// 3) Prepare the STK Push query payload
$timestamp = date('YmdHis');
$password  = base64_encode($BusinessShortCode . $Passkey . $timestamp);
$queryUrl  = 'https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query';

$queryData = [
    'BusinessShortCode' => $BusinessShortCode,
    'Password'          => $password,
    'Timestamp'         => $timestamp,
    'CheckoutRequestID' => $checkoutID
];

$headers = [
    "Authorization: Bearer $accessToken",
    'Content-Type: application/json'
];

// 4) Send the STK Push query request
$ch = curl_init($queryUrl);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($queryData));
$queryResp = curl_exec($ch);
curl_close($ch);

$data = json_decode($queryResp, true);

// 5) Return only the fields your frontend needs
echo json_encode([
    'ResultCode' => $data['ResultCode'] ?? null,
    'ResultDesc' => $data['ResultDesc'] ?? null
]);
