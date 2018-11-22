<?php

namespace src\Manager;

use app\Database\MySQLDatabase;
use src\Entity\User;

class UserManager
{
    private $db;

    public function __construct(MysqlDatabase $db)
    {
        $this->db = $db;
    }

    public function add(User $user)
    {
        $statement = 'INSERT INTO user(username, password) VALUES(?, ?)';
        $this->db->prepare($statement, [$user->getUsername(), $user->getPassword()], true);
    }

    public function remove($id)
    {
        $statement = 'DELETE FROM user WHERE id = ?';
        $this->db->prepare($statement, [(int)$id], true);
    }

    public function update(User $user)
    {
        $statement = 'UPDATE user SET username = ?, password = ? WHERE id = ?';
        $this->db->prepare($statement, [$user->getUsername(), $user->getPassword(), $user->getId()], true);
    }

}