<?php
function generateAccessToken() {
    $config = include 'config.php';
    $consumerKey = $config['consumerKey'];
    $consumerSecret = $config['consumerSecret'];

    $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERPWD, $consumerKey . ':' . $consumerSecret);
    $result = curl_exec($curl);
    curl_close($curl);

    $response = json_decode($result, true);
    return $response['access_token'] ?? null;
}
?>