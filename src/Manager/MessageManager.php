<?php

namespace src\Manager;


use app\Database\MySQLDatabase;
use src\Entity\Message;

/**
 * Class MessageManager
 * @package src\Manager
 */
class MessageManager
{
    /**
     * @var MySQLDatabase
     */
    private $db;

    /**
     * MessageManager constructor.
     * @param MySQLDatabase $db
     */
    public function __construct(MysqlDatabase $db)
    {
        $this->db = $db;
    }

    /**
     * @param Message $message
     */
    public function add(Message $message): void
    {
        $statement = 'INSERT INTO message(content, created_at, user_id) VALUES(?, ?, ?)';
        $this->db->prepare($statement, [$message->getContent(), $message->getCreatedAt(), $message->getUser()->getId()], true);
    }
}
