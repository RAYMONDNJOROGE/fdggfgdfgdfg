<?php
header('Content-Type: application/json');
if (file_exists('latest_payment.json')) {
    echo file_get_contents('latest_payment.json');
} else {
    echo json_encode(['status' => 'No payment found']);
}
