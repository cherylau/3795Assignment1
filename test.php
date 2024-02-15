<!-- this uses the Database class to establish the database connection -->
<?php

require 'Database.php'; 
require 'init_db.php';

$db = Database::getConnection();

// this function adds a new bucket to the buckets table
function addBucket($db, $category, $description) {
    $sql = "INSERT INTO buckets (category, description) VALUES (:category, :description)";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':category', $category, PDO::PARAM_STR);
    $stmt->bindValue(':description', $description, PDO::PARAM_STR);
    return $stmt->execute();
}

if (addBucket($db, 'Utilities', 'Monthly utility bills')) {
    echo "New bucket added successfully.";
} else {
    echo "Failed to add new bucket.";
}
?>
