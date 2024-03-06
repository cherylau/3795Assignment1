<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}
if (!isset($_SESSION['user_id'])) {
  header('location: index.php');
  exit;
}

include_once($_SERVER['DOCUMENT_ROOT'] . "/inc_header.php");
spl_autoload_register(function ($class_name) {
  include $_SERVER['DOCUMENT_ROOT'] . '/classes/' . $class_name . '.php';
});
include_once($_SERVER['DOCUMENT_ROOT'] . "/inc_db.php");

$transactions = Transaction::fetchAll();

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
    echo "<td>" . htmlspecialchars($transaction['transaction_id'] ?? '') . "</td>";
    echo "<td>" . htmlspecialchars($transaction['date'] ?? '') . "</td>";
    echo "<td>" . (is_numeric($transaction['credit']) ? '$' . number_format((float)$transaction['credit'], 2) : '--') . "</td>";
    echo "<td>" . (is_numeric($transaction['debit']) ? '$' . number_format((float)$transaction['debit'], 2) : '--') . "</td>";
    echo "<td>" . htmlspecialchars($transaction['description'] ?? '') . "</td>";
    echo "<td>" . htmlspecialchars($transaction['category'] ?? '') . "</td>";
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
