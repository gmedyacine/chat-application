<?php

namespace src\Manager;


use app\Database\MySQLDatabase;
use src\Entity\ChatSession;

/**
 * Class ChatSessionManager
 * @package src\Manager
 */
class ChatSessionManager
{
    /**
     * @var MySQLDatabase
     */
    private $db;

    /**
     * ChatSessionManager constructor.
     * @param MySQLDatabase $db
     */
    public function __construct(MysqlDatabase $db)
    {
        $this->db = $db;
    }

    /**
     * @param ChatSession $chatSession
     */
    public function add(ChatSession $chatSession): void
    {
        $statement = 'INSERT INTO chat_session(user_id, createdAt) VALUES(?, ?)';
        $date = (new \DateTime())->format('Y-m-d H:i:s');
        $this->db->prepare($statement, [$chatSession->getUser()->getId(), $date], true);
    }

    /**
     * @param ChatSession $chatSession
     */
    public function update(ChatSession $chatSession): void
    {
        $statement = 'UPDATE chat_session SET createdAt = ? WHERE user_id = ?';
        $date = (new \DateTime())->format('Y-m-d H:i:s');
        $this->db->prepare($statement, [$date, $chatSession->getUser()->getId()], true);
    }

    /**
     * @param $id
     */
    public function remove($id): void
    {
        $statement = 'DELETE FROM chat_session WHERE id = ?';
        $this->db->prepare($statement, [(int)$id], true);
    }
}
