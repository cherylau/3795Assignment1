<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header('location: index.php');
    exit;
}
include("../../inc_header.php");
spl_autoload_register(function ($class_name) {
    include $_SERVER['DOCUMENT_ROOT'] . '/classes/' . $class_name . '.php';
});

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