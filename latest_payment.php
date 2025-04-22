<?php
$filename = 'payments.json';

if (file_exists($filename)) {
    $all = json_decode(file_get_contents($filename), true);
    $latest = end($all); // last entry
    echo json_encode(['ResultCode' => 0, 'payment' => $latest]);
} else {
    echo json_encode(['ResultCode' => 1, 'message' => 'No payments yet']);
}
?>
