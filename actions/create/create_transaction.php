<?php
include("../../inc_header.php"); 
?>

<h1>Create New Transaction</h1>
<form action="create_transaction_process.php" method="post">
    <div class="form-group">
        <label for="Date" class="control-label">Date</label>
        <input type="date" class="form-control" name="Date" id="Date" required>
    </div>

    <div class="form-group">
        <label for="Amount" class="control-label">Amount</label>
        <input type="number" step="0.01" class="form-control" name="Amount" id="Amount" required>
    </div>

    <div class="form-group">
        <label for="Description" class="control-label">Description</label>
        <input type="text" class="form-control" name="Description" id="Description" required>
    </div>

    <div class="form-group">
        <input type="submit" value="Create" name="submit" class="btn btn-success">
        <a href="../../actions/display/display.php" class="btn btn-primary">&lt;&lt; BACK</a>
    </div>
</form>

<?php
include("../../inc_footer.php");
?>
