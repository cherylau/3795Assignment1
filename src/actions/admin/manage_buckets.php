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
$dashboardUrl = "../../dashboard/admin_dashboard.php";
$addKeywordUrl = "/actions/create/create_keyword.php";
echo "<h2>Keyword Records</h2>";
echo "<div class='d-flex justify-content-start'>";
echo "<a href='" . htmlspecialchars($dashboardUrl) . "' class='btn btn-primary'>Back To Dashboard</a>";
echo "<div class='mx-2'>";
echo "<a href='" . htmlspecialchars($addKeywordUrl) . "' class='btn btn-success'>Add New Keyword</a>";
echo "</div>";
echo "</div>";
echo "<br/>";
include($_SERVER['DOCUMENT_ROOT'] . "/tables/buckets.php");
displayBuckets(true);
