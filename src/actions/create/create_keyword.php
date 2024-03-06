<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header('location: index.php');
    exit;
}
include("../../inc_header.php");
?>

<h1>Add New Keyword</h1>
<form action="create_keyword_process.php" method="post">
    <div class="form-group">
        <label for="Keyword" class="control-label">Keyword</label>
        <input type="text" class="form-control" name="Keyword" id="Keyword" required>
    </div>

    <div class="form-group">
        <label for="Bucket_Id" class="control-label">Bucket ID</label>
        <input type="text" class="form-control" name="Bucket_Id" id="Bucket_Id" required>
    </div>

    <div class="form-group">
        <input type="submit" value="Create" name="submit" class="btn btn-success">
        <a href="../../actions/display/display.php" class="btn btn-primary">&lt;&lt; BACK</a>
    </div>
</form>

<?php
include("../../inc_footer.php");
?>
