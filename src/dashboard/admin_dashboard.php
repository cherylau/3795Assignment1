<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/inc_header.php");

session_start();
if (!isset($_SESSION['user_role'])) {
    header("Location: /");
    exit();
} else if ($_SESSION['user_role'] !== 'admin' && basename($_SERVER['PHP_SELF']) === 'admin_dashboard.php') {
    header("Location: /");
    exit();
} else if ($_SESSION['user_role'] !== 'user' && basename($_SERVER['PHP_SELF']) === 'user_dashboard.php') {
    header("Location: /");
    exit();
}
?>

<h2>Admin Dashboard</h2>
<p>Hello, <?= htmlspecialchars($_SESSION['user_email']) ?>! Here's what you can do:</p>

<ul>
    <li><a href="../actions/admin/admin_process.php">Approve Users</a></li>
    <li><a href="../actions/admin/manage_users.php">Manage Users and Their Buckets</a></li>
</ul>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/inc_footer.php"); ?>
