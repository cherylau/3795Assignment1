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
require_once("../../utils.php");
Database::getConnection();

if (isset($_POST['submit'])) {
    $category = sanitize_input($_POST['Category']);
    $description = sanitize_input($_POST['Description']);

    if (Bucket::create($category, $description)) {
        header("Location: ../../actions/display/display.php?message=Bucket+Created+Successfully");
    } else {
        header("Location: create_bucket.php?error=Unable+to+create+bucket");
    }
} else {
    header("Location: create_bucket.php?error=Form+submission+failed");
}
