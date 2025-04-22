<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['CheckoutRequestID'])) {
    date_default_timezone_set('Africa/Nairobi');

    $consumerKey = '1bvBpyAQdFgnAxVgrPOoE0wNlnqdgqmTGw2ifirVgeG0gscJ';
    $consumerSecret = 'hu1EnuMQO4asAmvwqRn65c5OZwDqTnYAz9hA5NQaL0GopQQOAkuJjRhGWFtOAiak';
    $BusinessShortCode = '174379';
    $Passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';

    $checkoutID = $_POST['CheckoutRequestID'];
    $timestamp = date('YmdHis');
    $password = base64_encode($BusinessShortCode . $Passkey . $timestamp);

    $tokenUrl = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
    $ch = curl_init($tokenUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, "$consumerKey:$consumerSecret");
    $access_token = json_decode(curl_exec($ch))->access_token ?? null;
    curl_close($ch);

    if (!$access_token) {
        echo json_encode(['error' => 'Failed to get token']);
        exit;
    }

    $queryUrl = 'https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query';
    $queryData = [
        'BusinessShortCode' => $BusinessShortCode,
        'Password' => $password,
        'Timestamp' => $timestamp,
        'CheckoutRequestID' => $checkoutID
    ];

    $headers = [
        'Content-Type: application/json',
        "Authorization: Bearer $access_token"
    ];

    $ch = curl_init($queryUrl);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($queryData));
    $result = curl_exec($ch);
    curl_close($ch);

    echo $result;
}
?>
