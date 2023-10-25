<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemNo = $_POST['itemNo'];
    $bidAmount = floatval($_POST['bidAmount']);

   
    $xml = simplexml_load_file('./xml/auction.xml');

    $listing = null;
    foreach ($xml->listing as $item) {
        if ((int)$item->itemNo === (int)$itemNo) {
            $listing = $item;
            break;
        }
    }

    if ($listing === null) {
        echo json_encode(['success' => false, 'message' => 'Item not found']);
    } else {

        $currentBid = floatval($listing->bidPrice);
        if ($bidAmount > $currentBid) {
           
            $listing->bidPrice = $bidAmount;

           
            $xml->asXML('./xml/auction.xml
            ');

            echo json_encode(['success' => true, 'message' => 'Bid placed successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Bid amount must be higher than the current bid']);
        }
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}

?>
