<!-- file to establishing database connection using PDO! -->

<!-- this implements the singleton pattern to connect to the database -->
<?php

class Database {
    private static $dbPath = __DIR__ . '/db.sqlite';
    private static $dbInstance = null;
    private function __construct() {}
    private function __clone() {}
    public static function getConnection() {
        if (self::$dbInstance === null) {
            try {
                self::$dbInstance = new PDO('sqlite:' . self::$dbPath);
                self::$dbInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                exit("Error connecting to the database: " . $e->getMessage());
            }
        }

        return self::$dbInstance;
    }
}
