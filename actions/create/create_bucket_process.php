<?php
include("../../inc_header.php");
require_once("../../src/classes/Bucket.php");
require_once("../../src/classes/Database.php");
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
