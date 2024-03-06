<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header('location: /');
    exit;
}
include("../../inc_header.php");
?>

<h1>Create New Bucket</h1>
<form action="create_bucket_process.php" method="post">
    <div class="form-group">
        <label for="Category" class="control-label">Category</label>
        <input type="text" class="form-control" name="Category" id="Category" required>
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
