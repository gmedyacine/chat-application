<?php

namespace src\Repository;


use app\Database\MySQLDatabase;
use src\Entity\User;

/**
 * Class UserRepository
 * @package src\Repository
 */
class UserRepository
{
    /**
     * @var MySQLDatabase
     */
    private $db;

    /**
     * UserRepository constructor.
     * @param MySQLDatabase $db
     */
    public function __construct(MysqlDatabase $db)
    {
        $this->db = $db;
    }

    /**
     * @param $id
     * @return User
     */
    public function find($id):User
    {
        $statement = 'SELECT * FROM user WHERE id = ?';
        $data = $this->db->prepare($statement, [(int)$id], true);
        return new User($data);
    }

    /**
     * @param $username
     * @return bool|User
     */
    public function findByUsername($username): User
    {
        $statement = 'SELECT * FROM user WHERE username = ?';
        $data = $this->db->prepare($statement, [$username], true);
        if ($data) {
            return new User($data);
        } else {
            return false;
        }
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        $users = [];
        $statement = 'SELECT * FROM user';
        $list = $this->db->prepare($statement, [], false);
        foreach ($list as $data) {
            $users[] = new User($data);
        }
        return $users;
    }
}
