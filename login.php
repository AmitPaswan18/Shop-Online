<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $xml = simplexml_load_file('./xml/customer.xml');

    if ($xml === false) {
        echo json_encode(['success' => false, 'message' => 'Failed to load customer data.']);
        exit();
    }

    foreach ($xml->customer as $customer) {
        $storedEmail = (string)$customer->email;
        $storedPasswordHash = (string)$customer->password;

        if ($storedEmail === $email && password_verify($password, $storedPasswordHash)) {
            echo json_encode(['success' => true, 'message' => 'Login successful']);

            exit();
        }
    }

    echo json_encode(['success' => false, 'message' => 'Login failed. Invalid email or password']);
}

?>
