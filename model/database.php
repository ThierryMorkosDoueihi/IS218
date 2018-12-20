<?php
class Database {
    private static $dsn = 'mysql:host=sql.njit.edu;dbname=tm334';
    private static $username = 'tm334';
    private static $password = 'C8BOrztwS';
    private static $db;
    private function __construct() {}
    public static function getDB () {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn,
                                     self::$username,
                                     self::$password);
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                include('../errors/database_error.php');
                exit();
            }
        }
        return self::$db;
    }
}
?>
