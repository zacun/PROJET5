<?php
namespace niluap\core;

class Manager {

    /**
     * @return \PDO
     */
    public function dbConnect() {
        $db = Database::getInstance();
        $req = $db->getPDO();
        return $req;
    }

    /**
     * @param $SqlStatement
     * @return \PDOStatement
     */
    public function query($SqlStatement) {
        $req = $this->dbConnect()->query($SqlStatement);
        return $req;
    }

    /**
     * @param $SqlStatement
     * @param $attributes
     * @param bool $fetch
     * @param bool $needOnlyOne
     * @return array|bool|mixed
     * Makes a prepared request depending on whether you want to fetch or not.
     */
    public function prepare($SqlStatement, $attributes, $fetch = false, $needOnlyOne = false) {
        $req = $this->dbConnect()->prepare($SqlStatement);
        $data = $req->execute($attributes);
        if ($fetch) {
            if ($needOnlyOne) {
                $data = $req->fetch();
            } else {
                $data = $req->fetchAll();
            }
            return $data;
        }
        return $data;
    }

    /**
     * @param $table
     * @param $id
     * @return array
     * This function is used to find if a comment, post, etc exist or not.
     * If $data is empty then the controller will make an alert message.
     */
    public function exist($table, $id) {
        $SqlStatement = 'SELECT id FROM ' . $table . ' WHERE id = ?';
        $req = $this->dbConnect()->prepare($SqlStatement);
        $req->execute([$id]);
        $data = $req->fetch();
        return $data;
    }

}