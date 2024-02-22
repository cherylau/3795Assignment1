<?php
include("../../inc_header.php");
require_once("../../src/classes/Bucket.php");
require_once("../../src/classes/Database.php");
Database::getConnection();

if (isset($_POST['bucketId'])) {
    $bucketId = $_POST['bucketId'];
    if (Bucket::delete($bucketId)) {
        header('Location: ../../actions/display/display.php?message=Transaction updated successfully');
    } else {
        header("Location: ../../actions/display/display.php?error=Unable+to+delete+bucket");
    }
} else {
    header("Location: ../../actions/display/display.php?error=No+Bucket+ID+provided");
}
?>