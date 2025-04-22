<?php
require_once 'generate_token.php';

if (isset($_POST['submit'])) {
    date_default_timezone_set('Africa/Nairobi');

    // Get configurations
    $config = include 'config.php';
    $BusinessShortCode = $config['businessShortCode'];
    $Passkey = $config['passkey'];
    $CallbackURL = $config['callbackUrl'];

    // Allowed fixed button values
    $allowedAmounts = [10, 20, 50, 80, 190, 650];
    $PartyA = $_POST['phone'];
    $Amount = (int) $_POST['amount'];

    // Validate phone number and amount
    if (!preg_match('/^254\d{9}$/', $PartyA) || !in_array($Amount, $allowedAmounts)) {
        echo json_encode(['ResponseCode' => '1', 'errorMessage' => 'Invalid Phone Number or Amount❌!']);
        exit;
    }

    // Generate Password and Timestamp
    $Timestamp = date('YmdHis');
    $Password = base64_encode($BusinessShortCode . $Passkey . $Timestamp);
    $AccountReference = 'TestAccount';
    $TransactionDesc = 'STK Push';

    // Generate Access Token
    $accessToken = generateAccessToken();
    if (!$accessToken) {
        echo json_encode(['ResponseCode' => '1', 'errorMessage' => '❌ Failed to Get Access Token']);
        exit;
    }

    // Send STK Push request
    $stkheader = [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $accessToken
    ];

    $postData = [
        'BusinessShortCode' => $BusinessShortCode,
        'Password' => $Password,
        'Timestamp' => $Timestamp,
        'TransactionType' => 'CustomerPayBillOnline',
        'Amount' => $Amount,
        'PartyA' => $PartyA,
        'PartyB' => $BusinessShortCode,
        'PhoneNumber' => $PartyA,
        'CallBackURL' => $CallbackURL,
        'AccountReference' => $AccountReference,
        'TransactionDesc' => $TransactionDesc
    ];

    $curl = curl_init('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest');
    curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($postData));
    $response = curl_exec($curl);
    curl_close($curl);

    $responseData = json_decode($response, true);

    // Return response with CheckoutRequestID to frontend
    header('Content-Type: application/json');
    echo json_encode([
        'ResponseCode' => $responseData['ResponseCode'] ?? '1',
        'CustomerMessage' => $responseData['CustomerMessage'] ?? '❌ Failed to Initiate STK Push',
        'CheckoutRequestID' => $responseData['CheckoutRequestID'] ?? null
    ]);
}
?>