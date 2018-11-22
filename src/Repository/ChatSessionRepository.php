<?php

namespace src\Repository;

use app\Database\MySQLDatabase;
use src\Entity\chatSession;

/**
 * Class ChatSessionRepository
 * @package src\Repository
 */
class ChatSessionRepository
{
    /**
     * @var MySQLDatabase
     */
    private $db;

    /**
     * ChatSessionRepository constructor.
     * @param MySQLDatabase $db
     */
    public function __construct(MysqlDatabase $db)
    {
        $this->db = $db;
    }

    /**
     * @param $userId
     * @return bool|chatSession
     */
    public function findByUserId($userId)
    {
        $statement = 'SELECT * FROM chat_session WHERE user_id = ?';
        $data = $this->db->prepare($statement, [$userId], true);
        if ($data) {
            return new ChatSession($data);
        } else {
            return false;
        }
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        $chatSessions = [];
        $statement = 'SELECT * FROM chat_session';
        $list = $this->db->prepare($statement, [], false);
        foreach ($list as $data) {
            $chatSessions[] = new ChatSession($data);
        }
        return $chatSessions;
    }

    /**
     * Pour récupérer l'id d'un user pour par la suite récupérer l'objet user
     * @param $id
     * @return int
     */
    public function getUserId($id): int
    {
        $statement = 'SELECT user_id FROM chat_session where id= ?';
        $userId = $this->db->prepare($statement, [$id], false);
        return $userId[0]['user_id'];
    }
}
