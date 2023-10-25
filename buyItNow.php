<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $itemNumber = $_POST['itemNumber'];
    $customerId = $_POST['customerId'];

 
    if ($isBuyItNowValid) {

        echo json_encode(['success' => true, 'message' => 'Thank you for purchasing this item.']);
    } else {

        echo json_encode(['success' => false, 'message' => 'Sorry, your purchase is not valid.']);
    }
}
