<?php
// Example DB insert for successful payment

$host = 'localhost';
$db = 'your_database';
$user = 'your_user';
$pass = 'your_password';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("INSERT INTO payments (phone, amount, checkout_id, timestamp) VALUES (?, ?, ?, ?)");
    $stmt->execute([$phone, $amount, $checkoutID, date('Y-m-d H:i:s')]);

} catch (PDOException $e) {
    file_put_contents('db_errors.log', $e->getMessage(), FILE_APPEND);
}
?>
