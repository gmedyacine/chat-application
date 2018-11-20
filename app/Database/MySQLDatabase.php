<?php
/**
 * Created by PhpStorm.
 * User: walid
 * Date: 11/20/2018
 * Time: 11:27 PM
 */

namespace app\Database;

use PDO;


class MySQLDatabase implements Database
{
    private $database;
    private $user;
    private $password;
    private $host;
    private $pdo;

    /**
     * MySQLDatabase constructor.
     * @param $database
     * @param string $user
     * @param string $password
     * @param string $host
     */
    public function __construct($database, $user = 'root', $password = '', $host = 'localhost')
    {
        $this->database = $database;
        $this->user = $user;
        $this->password = $password;
        $this->$host = $host;
    }

    /**
     * @return PDO
     */
    public function getPDO()
    {
        if ($this->pdo === null) {
            $pdo = new PDO('mysql:dbname='.$this->database.';host='.$this->host, $this->user, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

    /**
     * @param $statement
     * @param bool $one
     * @return array
     */
    public function query($statement, $one = false): array
    {
        $req = $this->getPDO()->query($statement);
        if(
            strpos($statement, 'UPDATE') === 0 ||
            strpos($statement, 'INSERT') === 0 ||
            strpos($statement, 'DELETE') === 0
        ) {
            return $req;
        }

        $req->setFetchMode(PDO::FETCH_ASSOC);

        if($one) {
            $datas = $req->fetch();
        } else {
            $datas = $req->fetchAll();
        }
        return $datas;
    }

    /**
     * @param $statement
     * @param $attributes
     * @param bool $one
     * @return array|bool|mixed
     */
    public function prepare($statement, $attributes, $one = false): array
    {
        $req = $this->getPDO()->prepare($statement);
        $res = $req->execute($attributes);
        if(
            strpos($statement, 'UPDATE') === 0 ||
            strpos($statement, 'INSERT') === 0 ||
            strpos($statement, 'DELETE') === 0
        ) {
            return $res;
        }
        $req->setFetchMode(PDO::FETCH_ASSOC);

        if($one) {
            $datas = $req->fetch();
        } else {
            $datas = $req->fetchAll();
        }
        return $datas;
    }

    /**
     * @return string
     */
    public function lastInsertId(): string
    {
        return $this->getPDO()->lastInsertId();
    }
}
