<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/inc_header.php");
spl_autoload_register(function ($class_name) {
  include $_SERVER['DOCUMENT_ROOT'] . '/classes/' . $class_name . '.php';
});

try {
  Database::getConnection();
  Database::initializeTables();
  Database::insertKeywordDataFromCSV();
  Database::insertCSVDataIntoBuckets();
  Admin::initalizeAdminUsers();
} catch (Exception $e) {
  echo "<p>Error setting up the database: " . $e->getMessage() . "</p>";
}

$buckets = Bucket::fetchAll();
$transactions = Transaction::fetchAll();

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

echo "<br/><br/><br/>";

echo "<h2>Transaction Records</h2>";
echo "<a href='/actions/create/create_transaction.php' class='btn btn-success'>Create New Transaction</a><br/><br/>";
echo "<a href='/actions/chart' class='btn btn-info'>View Chart</a><br/><br/>";

if (!empty($transactions)) {
  echo "<table width='100%' class='table table-striped'>";
  echo "<thead>";
  echo "<tr>";
  echo "<th>ID</th>";
  echo "<th>Date</th>";
  echo "<th>Credit</th>";
  echo "<th>Debit</th>";
  echo "<th>Description</th>";
  echo "<th>Category</th>";
  echo "<th>Actions</th>";
  echo "</tr>";
  echo "</thead>";
  echo "<tbody>";
  foreach ($transactions as $transaction) {


    echo "<tr>";
    echo "<td>" . htmlspecialchars($transaction['transaction_id']) . "</td>";
    echo "<td>" . htmlspecialchars($transaction['date']) . "</td>";
    echo "<td>" . (isset($transaction['credit']) && $transaction['credit'] !== NULL ? htmlspecialchars($transaction['credit']) : '-') . "</td>";
    echo "<td>" . (isset($transaction['debit']) && $transaction['debit'] !== NULL ? htmlspecialchars($transaction['debit']) : '-') . "</td>";
    echo "<td>" . htmlspecialchars($transaction['description']) . "</td>";
    echo "<td>" . htmlspecialchars($transaction['category']) . "</td>";
    echo "<td>";
    echo "<a href='/actions/update/update_transaction.php?id=" . htmlspecialchars($transaction['transaction_id']) . "' class='btn btn-dark '>Edit</a> ";
    echo "<a href='/actions/delete/delete_transaction.php?id=" . htmlspecialchars($transaction['transaction_id']) . "' class='btn btn-danger '>Delete</a>";
    echo "</td>";
    echo "</tr>";
  }
  echo "</tbody>";
  echo "</table>";
} else {
  echo "<p>No transaction records found.</p>";
}

include_once("../../inc_footer.php");
