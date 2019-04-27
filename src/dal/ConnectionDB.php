<?php
/**
 * Created by PhpStorm.
 * Filename: ConnectionDB.php
 * User: Andrei Gache
 * Email: andrei.gache.99@gmail.com
 * Website: https://www.andrei-gache.com/
 * Date: 27/04/19
 * Time: 11:24
 */

namespace HackathonEpsi\src\dal;

require_once __DIR__.'/../../config/.config.inc.php';

class ConnectionDB
{
    private $dbh;

    /**
     * ConnectionDB constructor.
     */
    public function __construct()
    {
        try {
            $this->dbh =  new \PDO('mysql:host=localhost;dbname='.DB_NAME, USER_MYSQl, PASSWORD_MYSQL);
        } catch (\PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function __destruct()
    {
        $this->dbh = null;
    }

    public function getConnection()
    {
        return $this->dbh;
    }
}