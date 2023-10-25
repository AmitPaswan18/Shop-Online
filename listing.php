<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemName = $_POST['itemName'];
    $itemNo = $_POST['itemNo'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $startPrice = $_POST['startPrice'];
    $reservePrice = $_POST['reservePrice'];
    $buyItNowPrice = $_POST['buyItNowPrice'];
    $days = $_POST['days'];
    $hours = $_POST['hours'];
    $minutes = $_POST['minutes'];

    if ($startPrice > $reservePrice) {
        echo 'Start price cannot be greater than the reserve price.';
        exit; 
    }

    if (file_exists('./xml/auction.xml')) {
        $xml = simplexml_load_file('./xml/auction.xml');
    } else {
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><listings></listings>');
    }

    $listing = $xml->addChild('listing');
    $listing->addChild('itemNo', $itemNo);
    $listing->addChild('itemName', $itemName);
    $listing->addChild('category', $category);
    $listing->addChild('description', $description);
    $listing->addChild('startPrice', $startPrice);
    $listing->addChild('reservePrice', $reservePrice);
    $listing->addChild('buyItNowPrice', $buyItNowPrice);
    $listing->addChild('duration', "$days days, $hours hours, $minutes minutes");

   
    $itemNo = generateItemNumber();
    $startDate = date('Y-m-d');
    $startTime = date('H:i:s');

    $listing->addChild('itemNo', $itemNo);
    $listing->addChild('startDate', $startDate);
    $listing->addChild('startTime', $startTime);

    $xml->asXML('./xml/auction.xml');

    echo 'Thank you! Your item has been listed in ShopOnline.';
    echo "The item number is $itemNo, and the bidding starts now: $startTime on $startDate";
}

function generateItemNumber() {
    
    return uniqid();
}
?>