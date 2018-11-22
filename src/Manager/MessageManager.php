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
        $statement = 'INSERT INTO message(content, createdAt, user_id) VALUES(?, ?, ?)';
        $date = (new \DateTime())->format('Y-m-d H:i:s');
        $this->db->prepare($statement, [$message->getContent(), $date, $message->getUser()->getId()], true);
    }
}
