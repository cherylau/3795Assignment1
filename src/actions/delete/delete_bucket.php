<?php
include("../../inc_header.php");
spl_autoload_register(function ($class_name) {
  include $_SERVER['DOCUMENT_ROOT'] . '/classes/' . $class_name . '.php';
});
require_once("../../utils.php");
Database::getConnection();


if (isset($_GET['id'])) {
  $bucketId = $_GET['id'];
  echo "<h1>Delete Bucket</h1>";
  echo "<p>Are you sure you want to delete the bucket with ID: {$bucketId}?</p>";
  echo "<form action='delete_bucket_process.php' method='post'>
            <input type='hidden' name='bucketId' value='{$bucketId}'>
            <input type='submit' value='Confirm' class='btn btn-danger'>
            <a href='../../actions/display/display.php' class='btn btn-primary'>Cancel</a>
        </form>";
} else {
  echo "<p>No bucket ID provided.</p>";
  echo "<a href='../../actions/display/display.php' class='btn btn-primary'>Go Back</a>";
}

include("../../inc_footer.php");
