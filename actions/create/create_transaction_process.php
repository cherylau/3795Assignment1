<?php
require_once("../../src/classes/Database.php");
require_once("../../utils.php");
require_once("../../src/classes/Transaction.php");

if (isset($_POST['submit'])) {
    $date = sanitize_input($_POST['Date']);
    $amount = sanitize_input($_POST['Amount']);
    $description = sanitize_input($_POST['Description']);
    $bucketId = sanitize_input($_POST['BucketId']);

    if (Transaction::create($date, $amount, $description, $bucketId)) {
        header("Location: ../../actions/display/display.php?message=Transaction+Created+Successfully");
    } else {
        header("Location: create_transaction.php?error=Unable+to+create+transaction");
    }
} else {
    header("Location: create_transaction.php?error=Form+submission+failed");
}
