<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemNo = $_POST['itemNo']; 
    $bidAmount = $_POST['bidAmount']; 

    if (empty($itemNo) || empty($bidAmount)) {
        echo 'Item number and bid amount are required.';
        exit;
    }

    if (!is_numeric($bidAmount) || $bidAmount <= 0) {
        echo 'Invalid bid amount.';
        exit;
    }

    $xmlFile = simplexml_load_file('./xml/auction.xml');
    
    if (!$xmlFile) {
        echo 'Failed to load auction data.';
        exit;
    }

    $listing = null;
    foreach ($xmlFile->listing as $item) {
        if ((string) $item->itemNumber === $itemNo) {
            $listing = $item;
            break;
        }
    }

    if (!$listing) {
        echo 'Item not found or auction has ended.';
        exit;
    }

    $startPrice = (float) $listing->startPrice;
    $reservePrice = (float) $listing->reservePrice;
    $buyItNowPrice = (float) $listing->buyItNowPrice;
    $currentBidPrice = (float) $listing->bidPrice;

    if ($bidAmount <= $currentBidPrice) {
        echo 'Your bid must be higher than the current bid.';
        exit;
    }

    if ($bidAmount < $startPrice) {
        echo 'Your bid must be higher than the starting price.';
        exit;
    }

    if ($bidAmount < $reservePrice) {
        echo 'Your bid must be higher than the reserve price.';
        exit;
    }

    if ($bidAmount >= $buyItNowPrice) {
        echo 'Congratulations! You have bought the item with Buy It Now.';
        $listing->bidPrice = $buyItNowPrice;
    } else {
        $listing->bidPrice = $bidAmount; 
        echo 'Your bid has been placed successfully.';
    }

    $xmlFile->asXML('./xml/auction.xml');
}
?>
