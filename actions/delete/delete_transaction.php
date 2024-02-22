<?php
include("../../inc_header.php");
require_once("../../src/classes/Bucket.php");
require_once("../../src/classes/Database.php");
require_once("../../utils.php");

Database::getConnection();

if (isset($_GET['id'])) {
    $transactionId = $_GET['id'];
    echo "<h1>Delete Transaction</h1>";
    echo "<p>Are you sure you want to delete the transaction with ID: {$transactionId}?</p>";
    echo "<form action='delete_transaction_process.php' method='post'>
            <input type='hidden' name='transactionId' value='{$transactionId}'>
            <input type='submit' value='Confirm' class='btn btn-danger'>
            <a href='../../actions/display/display.php'' class='btn btn-primary'>Cancel</a>
        </form>";
} else {
    echo "<p>No transaction ID provided.</p>";
    echo "<a href='../../actions/display/display.php' class='btn btn-primary'>Go Back</a>";
}

include("../../inc_footer.php");
?>