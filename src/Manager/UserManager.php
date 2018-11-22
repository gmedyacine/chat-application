<?php

namespace src\Manager;

use app\Database\MySQLDatabase;
use src\Entity\User;

/**
 * Class UserManager
 * @package src\Manager
 */
class UserManager
{
    /**
     * @var MySQLDatabase
     */
    private $db;

    /**
     * UserManager constructor.
     * @param MySQLDatabase $db
     */
    public function __construct(MysqlDatabase $db)
    {
        $this->db = $db;
    }

    /**
     * @param User $user
     */
    public function add(User $user): void
    {
        $statement = 'INSERT INTO user(username, password) VALUES(?, ?)';
        $this->db->prepare($statement, [$user->getUsername(), $user->getPassword()], true);
    }

    /**
     * @param $id
     */
    public function remove($id): void
    {
        $statement = 'DELETE FROM user WHERE id = ?';
        $this->db->prepare($statement, [(int)$id], true);
    }

    /**
     * @param User $user
     */
    public function update(User $user): void
    {
        $statement = 'UPDATE user SET username = ?, password = ? WHERE id = ?';
        $this->db->prepare($statement, [$user->getUsername(), $user->getPassword(), $user->getId()], true);
    }
}
