<?php
spl_autoload_register(function ($class_name) {
    include $_SERVER['DOCUMENT_ROOT'] . '/classes/' . $class_name . '.php';
});
require_once("../../utils.php");


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
