<?php
spl_autoload_register(function ($class_name) {
  include $_SERVER['DOCUMENT_ROOT'] . '/classes/' . $class_name . '.php';
});
require_once("../../utils.php");



if (isset($_POST['submit'])) {
  $date = sanitize_input($_POST['Date']);
  $amount = sanitize_input($_POST['Amount']);
  $description = sanitize_input($_POST['Description']);
  $transactionType = sanitize_input($_POST['TransactionType']);
  // $bucketId = sanitize_input($_POST['BucketId']);
  //TODO: get the bucketId 
  $bucketId = 1;


  $credit = $transactionType === 'Credit' ? $amount : NULL;
  $debit = $transactionType === 'Debit' ? $amount : NULL;

  if (Transaction::create($date, $credit, $debit, $description, $bucketId)) {
    header("Location: ../../actions/display/display.php?message=Transaction+Created+Successfully");
  } else {
    header("Location: create_transaction.php?error=Unable+to+create+transaction");
  }
} else {
  header("Location: create_transaction.php?error=Form+submission+failed");
}
