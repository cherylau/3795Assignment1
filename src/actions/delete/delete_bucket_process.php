<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (empty($_SESSION['user_role']) || $_SESSION['user_role'] !== 'user') {
  header('Location: /errors/error.php?type=user_only');
  exit;
}

include("../../inc_header.php");
spl_autoload_register(function ($class_name) {
    include $_SERVER['DOCUMENT_ROOT'] . '/classes/' . $class_name . '.php';
});
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