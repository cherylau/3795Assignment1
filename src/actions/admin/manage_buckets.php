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
});

$buckets = Bucket::fetchAll();

echo "<h2>Bucket Records Of All Users</h2>";
echo "<a href='/actions/create/create_bucket.php' class='btn btn-success'>Create New Bucket</a><br/><br/>";

if (!empty($buckets)) {
    echo "<table width='100%' class='table table-striped'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Category</th>";
    echo "<th>Description</th>";
    echo "<th>Actions</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    foreach ($buckets as $bucket) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($bucket['id']) . "</td>";
        echo "<td>" . htmlspecialchars($bucket['category']) . "</td>";
        echo "<td>" . htmlspecialchars($bucket['description']) . "</td>";
        echo "<td>";
        echo "<a href='/actions/update/update_bucket.php?id=" . htmlspecialchars($bucket['id']) . "' class='btn btn-dark'>Edit</a> ";
        echo "<a href='/actions/delete/delete_bucket.php?id=" . htmlspecialchars($bucket['id']) . "' class='btn btn-danger'>Delete</a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p>No bucket records found.</p>";
}
?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/inc_footer.php"); ?>
