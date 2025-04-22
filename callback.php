<?php
$data = file_get_contents("php://input");
$log = json_decode($data, true);

// Safely parse fields
$phone = $log['Body']['stkCallback']['CallbackMetadata']['Item'][4]['Value'] ?? '';
$amount = $log['Body']['stkCallback']['CallbackMetadata']['Item'][0]['Value'] ?? '';

$entry = [
    'phone' => $phone,
    'amount' => $amount
];

// Load existing
$existing = file_exists('payments.json') ? json_decode(file_get_contents('payments.json'), true) : [];

// Append new
$existing[] = $entry;

// Save back
file_put_contents('payments.json', json_encode($existing, JSON_PRETTY_PRINT));
