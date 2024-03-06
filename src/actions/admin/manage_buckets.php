<?php 
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (empty($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
  header('Location: /errors/error.php?type=admin_only');
  exit;
}

require_once($_SERVER['DOCUMENT_ROOT'] . "/inc_header.php");
spl_autoload_register(function ($class_name) {
    require $_SERVER['DOCUMENT_ROOT'] . '/classes/' . $class_name . '.php';
  include $_SERVER['DOCUMENT_ROOT'] . '/classes/' . $class_name . '.php';
});

include_once($_SERVER['DOCUMENT_ROOT'] . "/inc_header.php");
spl_autoload_register(function ($class_name) {
  include $_SERVER['DOCUMENT_ROOT'] . '/classes/' . $class_name . '.php';
});


echo "<h2>Bucket Records Of All Users</h2>";
echo "<a href='/actions/create/create_bucket.php' class='btn btn-success'>Create New Bucket</a><br/><br/>";

include($_SERVER['DOCUMENT_ROOT'] . "/tables/buckets.php");
displayBuckets(true);
