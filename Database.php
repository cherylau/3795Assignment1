<?php

class Database {
    private static $dbPath = '/school.db'; // Define the path relative to the document root
    private static $dbInstance = null;

    private function __construct() {}
    private function __clone() {}

    public static function getConnection() {
        if (self::$dbInstance === null) {
            $fullPath = $_SERVER['DOCUMENT_ROOT'] . self::$dbPath;
            try {
                self::$dbInstance = new SQLite3($fullPath);
            } catch (Exception $e) {
                exit("Error connecting to the database: " . $e->getMessage());
            }
        }

        return self::$dbInstance;
    }
}
