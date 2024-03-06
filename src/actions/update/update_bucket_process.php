<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header('location: /');
    exit;
}
include("../../inc_header.php");
require_once("../../classes/Bucket.php");
require_once("../../classes/Database.php");
require_once("../../utils.php");

Database::getConnection();

if (isset($_POST['submit'])) {
    $bucketId = sanitize_input($_POST['bucketId']);
    $category = sanitize_input($_POST['Category']);
    $description = sanitize_input($_POST['Description']);
    $success = Bucket::update($bucketId, $category, $description);

    if ($success) {
        header('Location: ../../actions/display/display.php?message=Transaction updated successfully');
    } else {
        header('Location: update_bucket.php?id=' . $bucketId . '&error=Unable to update the bucket');
    }
    exit;
}
