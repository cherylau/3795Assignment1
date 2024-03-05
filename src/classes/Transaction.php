<?php
class Transaction
{
  public static function fetchAll()
  {
    $db = Database::getConnection();
    $result = $db->query('SELECT * FROM transactions');
    $transactions = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
      $transactions[] = $row;
    }
    return $transactions;
  }
  public static function importFromCSV($filePath)
  {
    $db = Database::getConnection();
    $insertedTransactions = [];

    if (($handle = fopen($filePath, "r")) !== FALSE) {
      fgetcsv($handle);
      while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $date = $data[0];
        $description = $data[1];
        $credit = $data[2];
        $debit = $data[3];
        $bucketId = null;

        $stmt = $db->prepare('INSERT INTO transactions (date, credit, debit, description, bucket_id) VALUES (?, ?, ?, ?, ?)');
        $stmt->bindValue(1, $date, SQLITE3_TEXT);
        $stmt->bindValue(2, $credit, SQLITE3_FLOAT);
        $stmt->bindValue(3, $debit, SQLITE3_FLOAT);
        $stmt->bindValue(4, $description, SQLITE3_TEXT);
        $stmt->bindValue(5, $bucketId, SQLITE3_INTEGER);
        $stmt->execute();


        $insertedTransactions[] = [
          'date' => $date,
          'description' => $description,
          'credit' => $credit,
          'debit' => $debit,
          'bucketId' => $bucketId
        ];
      }
      fclose($handle);
    }


    return $insertedTransactions;
  }



  public static function update($transactionId, $date, $credit, $debit, $description, $bucketId)
  {
    $db = Database::getConnection();
    $stmt = $db->prepare('UPDATE transactions SET date = ?, amount = ?, description = ?, bucket_id = ? WHERE transaction_id = ?');
    $stmt->bindValue(1, $date, SQLITE3_TEXT);
    $stmt->bindValue(2, $credit, SQLITE3_FLOAT);
    $stmt->bindValue(3, $debit, SQLITE3_FLOAT);
    $stmt->bindValue(3, $description, SQLITE3_TEXT);
    $stmt->bindValue(4, $bucketId, SQLITE3_INTEGER);
    $stmt->bindValue(5, $transactionId, SQLITE3_INTEGER);
    return $stmt->execute() ? true : false;
  }

  public static function findById($transactionId)
  {
    $db = Database::getConnection();
    $stmt = $db->prepare('SELECT * FROM transactions WHERE transaction_id = ?');
    $stmt->bindValue(1, $transactionId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    return $result->fetchArray(SQLITE3_ASSOC);
  }

  public static function delete($transactionId)
  {
    $db = Database::getConnection();
    $stmt = $db->prepare("DELETE FROM transactions WHERE transaction_id = ?");
    $stmt->bindValue(1, $transactionId, SQLITE3_INTEGER);
    return $stmt->execute() ? true : false;
  }

  public static function create($date, $credit, $debit, $description, $bucketId)
  {
    $db = Database::getConnection();
    $stmt = $db->prepare('INSERT INTO transactions (date, amount, description, bucket_id) VALUES (?, ?, ?, ?)');
    $stmt->bindValue(1, $date, SQLITE3_TEXT);
    $stmt->bindValue(2, $credit, SQLITE3_FLOAT);
    $stmt->bindValue(3, $debit, SQLITE3_FLOAT);
    $stmt->bindValue(3, $description, SQLITE3_TEXT);
    $stmt->bindValue(4, $bucketId, SQLITE3_INTEGER);
    return $stmt->execute() ? true : false;
  }
}
