<?php
class Transaction {
    public static function fetchAll() {
        $db = Database::getConnection();
        $result = $db->query('SELECT * FROM transactions');
        $transactions = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $transactions[] = $row;
        }
        return $transactions;
    }
    public static function importFromCSV($filePath) {
        $db = Database::getConnection();
        if (($handle = fopen($filePath, "r")) !== FALSE) {
            fgetcsv($handle);
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $date = $data[0];
                $location = $data[1];
                $credit = $data[2];
                $debit = $data[3];
                $total = $data[4];

                $stmt = $db->prepare("INSERT INTO transactions (date, location, credit, debit, total) VALUES (?, ?, ?, ?, ?)");
                $stmt->bindValue(1, $date, SQLITE3_TEXT);
                $stmt->bindValue(2, $location, SQLITE3_TEXT);
                $stmt->bindValue(3, $credit, SQLITE3_FLOAT);
                $stmt->bindValue(4, $debit, SQLITE3_FLOAT);
                $stmt->bindValue(5, $total, SQLITE3_FLOAT);
                $stmt->execute();
            }
            fclose($handle);
        }
    }



    public static function update($transactionId, $date, $amount, $description, $bucketId) {
        $db = Database::getConnection();
        $stmt = $db->prepare('UPDATE transactions SET date = ?, amount = ?, description = ?, bucket_id = ? WHERE transaction_id = ?');
        $stmt->bindValue(1, $date, SQLITE3_TEXT);
        $stmt->bindValue(2, $amount, SQLITE3_FLOAT);
        $stmt->bindValue(3, $description, SQLITE3_TEXT);
        $stmt->bindValue(4, $bucketId, SQLITE3_INTEGER);
        $stmt->bindValue(5, $transactionId, SQLITE3_INTEGER);
        return $stmt->execute() ? true : false;
    }

    public static function findById($transactionId) {
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT * FROM transactions WHERE transaction_id = ?');
        $stmt->bindValue(1, $transactionId, SQLITE3_INTEGER);
        $result = $stmt->execute();
        return $result->fetchArray(SQLITE3_ASSOC);
    }

    public static function delete($transactionId) {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM transactions WHERE transaction_id = ?");
        $stmt->bindValue(1, $transactionId, SQLITE3_INTEGER);
        return $stmt->execute() ? true : false;
    }

    public static function create($date, $amount, $description, $bucketId) {
        $db = Database::getConnection();
        $stmt = $db->prepare('INSERT INTO transactions (date, amount, description, bucket_id) VALUES (?, ?, ?, ?)');
        $stmt->bindValue(1, $date, SQLITE3_TEXT);
        $stmt->bindValue(2, $amount, SQLITE3_FLOAT);
        $stmt->bindValue(3, $description, SQLITE3_TEXT);
        $stmt->bindValue(4, $bucketId, SQLITE3_INTEGER);
        return $stmt->execute() ? true : false;
    }
}
?>