<?php
if (isset($_POST['submit'])) {
    date_default_timezone_set('Africa/Nairobi');

    // Safaricom credentials (replace with your real ones)
    $consumerKey = '1bvBpyAQdFgnAxVgrPOoE0wNlnqdgqmTGw2ifirVgeG0gscJ';
    $consumerSecret = 'hu1EnuMQO4asAmvwqRn65c5OZwDqTnYAz9hA5NQaL0GopQQOAkuJjRhGWFtOAiak';
    $BusinessShortCode = '174379';
    $Passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';

    // Acceptable amounts
    $allowedAmounts = [10, 20, 50, 80, 190, 650];

    $PartyA = $_POST['phone'];
    $Amount = (int) $_POST['amount'];

    // Validate input
    if (!preg_match('/^254\d{9}$/', $PartyA) || !in_array($Amount, $allowedAmounts)) {
        echo json_encode(['ResponseCode' => '1', 'errorMessage' => 'Invalid phone number or amount']);
        exit;
    }

    // STK push data setup
    $Timestamp = date('YmdHis');
    $Password = base64_encode($BusinessShortCode . $Passkey . $Timestamp);
    $AccountReference = 'Raynger Networks';
    $TransactionDesc = 'STK Push Payment';
    $CallBackURL = 'https://your-heroku-app.herokuapp.com/callback.php'; // replace this

    // Get access token
    $tokenUrl = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
    $ch = curl_init($tokenUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, "$consumerKey:$consumerSecret");
    $access_token = json_decode(curl_exec($ch))->access_token ?? null;
    curl_close($ch);

    if (!$access_token) {
        echo json_encode(['ResponseCode' => '1', 'errorMessage' => 'Failed to get access token']);
        exit;
    }

    // Initiate STK Push
    $stkData = [
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

    $stkHeaders = [
        'Content-Type: application/json',
        "Authorization: Bearer $access_token"
    ];

    $ch = curl_init('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $stkHeaders);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($stkData));
    $response = curl_exec($ch);
    curl_close($ch);

    $responseData = json_decode($response, true);

    // Return data to frontend
    echo json_encode([
        'ResponseCode' => $responseData['ResponseCode'] ?? '1',
        'CustomerMessage' => $responseData['CustomerMessage'] ?? 'Failed to initiate STK Push',
        'CheckoutRequestID' => $responseData['CheckoutRequestID'] ?? null,
        'startPolling' => true
    ]);
}
?>