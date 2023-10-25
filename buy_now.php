
<?php
include 'config.php';
$purchaseStatus = 'Successful';

header('Content-Type: application/json');
echo json_encode(array('purchaseStatus' => $purchaseStatus));
?>
