<?php
include("../../inc_header.php");
spl_autoload_register(function ($class_name) {
    include $_SERVER['DOCUMENT_ROOT'] . '/classes/' . $class_name . '.php';
});
require_once("../../utils.php");
Database::getConnection();

if (isset($_POST['submit'])) {
    $keyword = sanitize_input($_POST['Keyword']);
    $bucket_id = sanitize_input($_POST['Bucket_Id']);

    if (Keyword::create($keyword, $bucket_id)) {
        header("Location: ../../actions/display/display.php?message=Keyword+Created+Successfully");
    } else {
        header("Location: create_keyword.php?error=Unable+to+create+keyword");
    }
} else {
    header("Location: create_keyword.php?error=Form+submission+failed");
}
