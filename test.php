<?php

require 'Database.php'; 
require 'init_db.php';

$db = Database::getConnection();

// this function adds a new bucket to the buckets tablefunction addBucket($db, $category, $description) {
function addBucket($db, $category, $description) {
    
    $sql = 'INSERT INTO buckets (category, description) VALUES (?, ?)';
    $stmt = $db->prepare($sql);

    $stmt->bindValue(1, $category, SQLITE3_TEXT);
    $stmt->bindValue(2, $description, SQLITE3_TEXT);
    $result = $stmt->execute();
    return $result !== false;
}

if (addBucket($db, 'Utilities', 'Monthly utility bills')) {
    echo "New bucket added successfully.";
} else {
    echo "Failed to add new bucket.";
}


?>
