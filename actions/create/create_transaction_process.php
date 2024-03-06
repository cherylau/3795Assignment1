<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header('location: /');
    exit;
}

require_once("../../src/classes/Database.php");
require_once("../../utils.php");
require_once("../../src/classes/Transaction.php");


if (isset($_POST['submit'])) {
    $date = sanitize_input($_POST['Date']);
    $amount = sanitize_input($_POST['Amount']);
    $description = sanitize_input($_POST['Description']);
    $bucketId = sanitize_input($_POST['BucketId']);

    if (Transaction::create($date, $credit, $debit, $description, $bucket_id)) {
        header("Location: ../../actions/display/display.php?message=Transaction+Created+Successfully");
    } else {
        header("Location: create_transaction.php?error=Unable+to+create+transaction");
    }
} else {
    header("Location: create_transaction.php?error=Form+submission+failed");
}
