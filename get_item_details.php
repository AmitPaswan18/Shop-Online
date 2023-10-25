<?php
include 'config.php';
$itemData = array(
    'itemNumber' => '12345',
    'itemName' => 'Sample Item',
    'category' => 'Electronics',
    'description' => 'This is a sample item description.',
    'buyItNowPrice' => 100.00,
    'bidPrice' => 50.00,
    'duration' => '5 days',
);
header('Content-Type: application/json');
echo json_encode($itemData);
?>
