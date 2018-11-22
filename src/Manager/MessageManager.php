<?php
/**
 * Created by PhpStorm.
 * User: walid
 * Date: 11/21/2018
 * Time: 12:56 AM
 */

namespace src\Manager;


use app\Database\MySQLDatabase;
use src\Entity\Message;

class MessageManager
{
    private $db;

    public function __construct(MysqlDatabase $db)
    {
        $this->db = $db;
    }

    public function add(Message $message)
    {
        $statement = 'INSERT INTO message(content, createdAt, user_id) VALUES(?, ?, ?)';
        $date = (new \DateTime())->format('Y-m-d H:i:s');
        $this->db->prepare($statement, [$message->getContent(), $date, $message->getUser()->getId()], true);
    }
}