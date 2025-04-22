<?php
if (isset($_POST['submit'])) {
    date_default_timezone_set('Africa/Nairobi');

    // Safaricom credentials
    $consumerKey = '1bvBpyAQdFgnAxVgrPOoE0wNlnqdgqmTGw2ifirVgeG0gscJ';
    $consumerSecret = 'hu1EnuMQO4asAmvwqRn65c5OZwDqTnYAz9hA5NQaL0GopQQOAkuJjRhGWFtOAiak';
    $BusinessShortCode = '174379';
    $Passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';

    // Allowed fixed button values
    $allowedAmounts = [10, 20, 50, 80, 190, 650];

    $PartyA = $_POST['phone'];
    $Amount = (int) $_POST['amount'];

    if (!preg_match('/^254\d{9}$/', $PartyA) || !in_array($Amount, $allowedAmounts)) {
        echo json_encode(['ResponseCode' => '1', 'errorMessage' => '❌ Invalid Phone Number']);
        exit;
    }

    $Timestamp = date('YmdHis');
    $Password = base64_encode($BusinessShortCode . $Passkey . $Timestamp);
    $AccountReference = 'Raynger';
    $TransactionDesc = 'STK Push';
    $CallBackURL = 'https://shrouded-meadow-45282-36291630ca1c.herokuapp.com/callback.php'; // Replace with your actual callback URL

    // Step 1: Get access token
    $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
    $curl = curl_init($access_token_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERPWD, $consumerKey . ':' . $consumerSecret);
    $result = curl_exec($curl);
    curl_close($curl);

    $access_token = json_decode($result)->access_token ?? null;
    if (!$access_token) {
        echo json_encode(['ResponseCode' => '1', 'errorMessage' => '❌ Failed to Get Access Token']);
        exit;
    }

    // Step 2: Send STK Push request
    $stkheader = [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $access_token
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
        'CallBackURL' => $CallBackURL,
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
