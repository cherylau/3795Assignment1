
<?php

require_once 'Database.php';
class User {
    public static function register($email, $password) {
        $db = Database::getConnection();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // hash the password!!
        $stmt = $db->prepare('INSERT INTO users (email, password) VALUES (:email, :password)');
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':password', $hashedPassword, SQLITE3_TEXT);
        return $stmt->execute();
    }

    public static function findByEmail($email) {
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);
        return $result;
    }

    public static function isApproved($userId) {
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT is_approved FROM users WHERE id = :id');
        $stmt->bindValue(':id', $userId, SQLITE3_INTEGER);
        $result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);
        return $result && $result['is_approved'] == 1;
    }

    
}
