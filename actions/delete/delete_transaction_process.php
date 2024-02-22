<?php
include("../../inc_header.php");
require_once("../../src/classes/Database.php");
require_once("../../src/classes/Transaction.php");

Database::getConnection();
if (isset($_POST['transactionId'])) {
    $transactionId = $_POST['transactionId'];
    if (Transaction::delete($transactionId)) {
        header('Location: ../../actions/display/display.php?message=Transaction deleted successfully');
    } else {
        header("Location: ../../actions/display/display.php?error=Unable+to+delete+transaction");
    }
} else {
    header("Location: ../../actions/display/display.php?error=No+Transaction+ID+provided");
}