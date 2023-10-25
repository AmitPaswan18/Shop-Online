<?php
$xml = simplexml_load_file('./xml/customer.xml');


$customer = $xml->addChild('customer');
$customer->addChild('id', generateUniqueId()); 
$customer->addChild('firstName', $_POST['firstName']);
$customer->addChild('surname', $_POST['surname']);
$customer->addChild('email', $_POST['email']);
$customer->addChild('password', password_hash($_POST['password'], PASSWORD_BCRYPT)); 

$xml->asXML('./xml/customer.xml');

echo 'Registration successful!';

function generateUniqueId() {
    return uniqid();
}
?>
