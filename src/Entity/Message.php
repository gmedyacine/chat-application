<?php

namespace src\Entity;

use app\Entity;
use src\Entity\User;

/**
 * Class Message
 * @package src\Entity
 */
class Message extends Entity
{
    /**
     * @var int clé
     */
    private $id;
    /**
     * @var User classe User
     */
    private $user;
    /**
     * @var \DateTime de création de l'entité
     */
    private $createdAt;
    /**
     * @var string contenu du message à afficher
     */
    private $content;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return Message
     */
    public function setId($id): Message
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return \src\Entity\User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param \src\Entity\User $user
     * @return Message
     */
    public function setUser(User $user): Message
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param $createdAt
     * @return Message
     */
    public function setCreatedAt($createdAt): Message
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param $content
     * @return Message
     */
    public function setContent($content): Message
    {
        $this->content = $content;

        return $this;
    }
}
