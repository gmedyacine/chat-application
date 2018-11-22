<?php

namespace src\Repository;


use app\Database\MySQLDatabase;
use src\Entity\Message;

/**
 * Class MessageRepository
 * @package src\Repository
 */
class MessageRepository
{
    /**
     * @var MySQLDatabase
     */
    private $db;

    /**
     * MessageRepository constructor.
     * @param MySQLDatabase $db
     */
    public function __construct(MysqlDatabase $db)
    {
        $this->db = $db;
    }


    /**
     * @param $id
     * @return Message
     */
    public function find($id): Message
    {
        $statement = 'SELECT * FROM message WHERE id = ?';
        $data = $this->db->prepare($statement, [(int)$id], true);
        return new Message($data);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        $messages = [];
        $statement = 'SELECT * FROM message';
        $list = $this->db->prepare($statement, [], false);
        foreach ($list as $data) {
            $messages[] = new Message($data);
        }
        return $messages;
    }

    /**
     * @return MySQLDatabase
     */
    public function getDb(): MySQLDatabase
    {
        return $this->db;
    }

    /**
     * @param MySQLDatabase $db
     */
    public function setDb(MySQLDatabase $db): void
    {
        $this->db = $db;
    }

}
