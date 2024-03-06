<?php
require_once("../../classes/Database.php");
require_once("../../utils.php");
require_once("../../classes/Transaction.php");

Database::getConnection();

if (isset($_POST['submit'])) {
  $transactionId = sanitize_input($_POST['transaction_id']);
  $date = sanitize_input($_POST['date']);
  $credit = sanitize_input($_POST['credit']);
  $debit = sanitize_input($_POST['debit']);
  $description = sanitize_input($_POST['description']);
  $bucketId = sanitize_input($_POST['bucket_id']);
  $success = Transaction::update($transactionId, $date, $credit, $debit, $description, $bucket_id);

  if ($success) {
    header('Location: ../../actions/display/display.php?message=Transaction updated successfully');
  } else {
    header('Location: update_transaction.php?id=' . $transactionId . '&error=Unable to update the transaction');
  }
  exit;
}
?>
