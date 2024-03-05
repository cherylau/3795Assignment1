<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/classes/Database.php");

try {
  $db = Database::getConnection();
  Database::insertMockDataIntoBuckets();
  // Database::insertMockDataIntoTransactions();
} catch (Exception $e) {
  echo "<p>" . $e->getMessage() . "</p>";
}