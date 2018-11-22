<?php

namespace src\Entity;


use app\Entity;
use src\Entity\User;
use src\Manager\ChatSessionManager;

/**
 * Class ChatSession
 * @package src\Entity
 */
class ChatSession extends Entity
{
    /**
     * @var int clé
     */
    private $id;
    /**
     * @var User La classe User
     */
    private $user;
    /**
     * @var \DateTime de création de l'entité
     */
    private $createdAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return ChatSession
     */
    public function setId($id): ChatSession
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return \src\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return ChatSession
     */
    public function setUser(User $user): ChatSession
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param $createdAt
     * @return ChatSession
     */
    public function setCreatedAt($createdAt): ChatSession
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}