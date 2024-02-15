<?php
$dbPath = __DIR__. "/db.sqlite";
$db = new PDO("sqlite:$dbPath");
$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


//make buckets table
$createBucketsTable = "
    CREATE TABLE IF NOT EXISTS buckets (
        transaction_id INTEGER PRIMARY KEY AUTOINCREMENT,
        category TEXT NOT NULL,
        description TEXT NOT NULL
    );";


// make transactions table
$createTransactionsTable = "
    CREATE TABLE IF NOT EXISTS transactions (
        transaction_id INTEGER PRIMARY KEY AUTOINCREMENT,
        date TEXT NOT NULL,
        amount REAL NOT NULL,
        bucket_id INTEGER,
        FOREIGN KEY (bucket_id) REFERENCES buckets(transaction_id)
    );";


// try to make the tables

try {
    $db -> exec($createBucketsTable);
    echo "Created buckets table\n";
} catch (PDOException $e) {
    echo "Error creating buckets table: " . $e -> getMessage() . "\n";
}

try {
    $db -> exec($createTransactionsTable);
    echo "Created transactions table\n";
} catch (PDOException $e) {
    echo "Error creating transactions table: " . $e -> getMessage() . "\n";
}

// close the database connection maybe?
// $db = null;

//TODO:  make a keyword and category table

$checkTables = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND (name='buckets' OR name='transactions');");
$tables = $checkTables->fetchAll(PDO::FETCH_COLUMN);

if (in_array('buckets', $tables) && in_array('transactions', $tables)) {
    echo "the tables exist!\n";
} else {
    echo "a table or both tables are missing@.\n";
}
?>
