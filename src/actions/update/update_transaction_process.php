<?php
require_once("../../src/classes/Database.php");
require_once("../../utils.php");
require_once("../../src/classes/Transaction.php");

Database::getConnection();

if (isset($_POST['submit'])) {
  $transactionId = sanitize_input($_POST['transactionId']);
  $date = sanitize_input($_POST['Date']);
  $amount = sanitize_input($_POST['Amount']);
  $description = sanitize_input($_POST['Description']);
  $bucketId = sanitize_input($_POST['BucketId']);
  $success = Transaction::update($transactionId, $date, $credit, $debit, $description, $bucketId);

  if ($success) {
    header('Location: ../../actions/display/display.php?message=Transaction updated successfully');
  } else {
    header('Location: update_transaction.php?id=' . $transactionId . '&error=Unable to update the transaction');
  }
  exit;
}
