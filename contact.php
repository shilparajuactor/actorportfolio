<?php
// Simple handler: contact.php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /');
    exit;
}

$first = trim(filter_input(INPUT_POST, 'first-name', FILTER_SANITIZE_STRING) ?? '');
$last = trim(filter_input(INPUT_POST, 'last-name', FILTER_SANITIZE_STRING) ?? '');
$email = filter_input(INPUT_POST, 'email-address', FILTER_VALIDATE_EMAIL);
$message = trim(filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING) ?? '');

if (!$email) {
    header('Location: /?error=invalid_email');
    exit;
}

$to = 'shilparajuactor@gmail.com'; // <-- change this
$subject = "Website contact from $first $last";
$body = "Name: $first $last\nEmail: $email\n\nMessage:\n$message\n";
$headers = "From: noreply@" . ($_SERVER['SERVER_NAME'] ?? 'yourdomain.com') . "\r\n";
$headers .= "Reply-To: $email\r\n";

if (mail($to, $subject, $body, $headers)) {
    header('Location: /?sent=1');
    exit;
} else {
    header('Location: /?sent=0');
    exit;
}
?>
