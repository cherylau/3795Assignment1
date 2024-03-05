<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/inc_header.php");
spl_autoload_register(function ($class_name) {
  include $_SERVER['DOCUMENT_ROOT'] . '/classes/' . $class_name . '.php';
});
include_once($_SERVER['DOCUMENT_ROOT'] . "/inc_db.php");
$buckets = Bucket::fetchAll();

echo "<h2>Bucket Records</h2>";
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