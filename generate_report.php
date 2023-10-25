<?php
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $xml = simplexml_load_file("auction_items.xml");

    $reportContent = "Maintenance Report:\n";
 
    echo $reportContent;
}
?>