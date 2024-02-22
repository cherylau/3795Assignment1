<?php
include("../../inc_header.php");
require_once("../../src/classes/Transaction.php");
require_once("../../src/classes/Database.php");

Database::getConnection();

if (isset($_GET['id'])) {
    $transactionId = $_GET['id'];
    $transaction = Transaction::findById($transactionId);
    if ($transaction) {
        ?>
        <h1>Update Transaction</h1>
        <form action="update_transaction_process.php" method="post">
            <input type="hidden" name="transactionId" value="<?php echo htmlspecialchars($transaction['transaction_id']); ?>">
            <div class="form-group">
                <label for="Date" class="control-label">Date</label>
                <input type="text" class="form-control" name="Date" id="Date" value="<?php echo $transaction['date']; ?>">
            </div>
            <div class="form-group">
                <label for="Amount" class="control-label">Amount</label>
                <input type="number" step="0.01" class="form-control" name="Amount" id="Amount" value="<?php echo $transaction['amount']; ?>">
            </div>
            <div class="form-group">
                <label for="Description" class="control-label">Description</label>
                <input type="text" class="form-control" name="Description" id="Description" value="<?php echo $transaction['description']; ?>">
            </div>
            <div class="form-group">
                <label for="BucketId" class="control-label">Bucket ID</label>
                <input type="number" class="form-control" name="BucketId" id="BucketId" value="<?php echo $transaction['bucket_id']; ?>">
            </div>
            <div class="form-group">
                <a href="../../actions/display/display.php" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
                <input type="submit" value="Update" name="submit" class="btn btn-warning">
            </div>
        </form>
        <?php
    } else {
        echo "<p>Transaction with ID $transactionId not found.</p>";
    }
} else {
    echo "<p>No transaction ID provided.</p>";
}

include("../../inc_footer.php");
?>
