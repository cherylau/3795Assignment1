<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/inc_header.php");
spl_autoload_register(function ($class_name) {
  include $_SERVER['DOCUMENT_ROOT'] . '/classes/' . $class_name . '.php';
});
include_once($_SERVER['DOCUMENT_ROOT'] . "/inc_db.php");
$keywords = Keyword::fetchAll();

echo "<h2>Keyword Records</h2>";
echo "<a href='/actions/create/create_keyword.php' class='btn btn-success'>Add New Keyword</a><br/><br/>";

if (!empty($keywords)) {
  echo "<table width='100%' class='table table-striped'>";
  echo "<thead>";
  echo "<tr>";
  echo "<th>ID</th>";
  echo "<th>Keyword</th>";
  echo "<th>Category</th>";
  echo "<th>Actions</th>";
  echo "</tr>";
  echo "</thead>";
  echo "<tbody>";
  foreach ($keywords as $keyword) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($keyword['id']) . "</td>";
    echo "<td>" . htmlspecialchars($keyword['keyword']) . "</td>";
    echo "<td>" . htmlspecialchars($keyword['category']) . "</td>";
    echo "<td>";
    echo "<a href='/actions/update/update_keyword.php?id=" . htmlspecialchars($keyword['id']) . "' class='btn btn-dark'>Edit</a> ";
    echo "<a href='/actions/delete/delete_keyword.php?id=" . htmlspecialchars($keyword['id']) . "' class='btn btn-danger'>Delete</a>";
    echo "</td>";
    echo "</tr>";
  }
  echo "</tbody>";
  echo "</table>";
} else {
  echo "<p>No keyword records found.</p>";
}
?>