<?php
namespace niluap\core;

use \PDO;

/**
 * Class Database
 * @package niluap\core
 * Class connecting to the database with PDO.
 * It's a singleton.
 */
class Database {

    private $db_host;
    private $db_name;
    private $db_user;
    private $db_password;
    private $pdo;

    private static $_instance;

    /**
     * @return Database
     * Singleton.
     */
    public static function getInstance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new Database('projet5');
        }
        return self::$_instance;
    }

    public function __construct($db_name, $db_host = 'localhost', $db_user = 'root', $db_password = '') {
        $this->db_host = $db_host;
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_password = $db_password;
    }

    /**
     * @return PDO
     * Authentification to db with PDO
     */
    public function getPDO() {
        if (is_null($this->pdo)) {
            $pdo = new PDO('mysql:host=' . $this->db_host . ';dbname=' . $this->db_name, $this->db_user, $this->db_password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

}