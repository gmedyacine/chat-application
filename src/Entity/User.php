<?php

namespace src\Entity;

use app\Entity;

/**
 * Class User
 * @package src\Entity
 */
class User extends Entity
{
    /**
     * @var int clé du user
     */
    private $id;
    /**
     * @var string pseudo, login etc
     */
    private $username;
    /**
     * @var string mdp
     */
    private $password;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return User
     */
    public function setId($id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param $username
     * @return User
     */
    public function setUsername($username): User
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $password
     * @return User
     */
    public function setPassword($password): User
    {
        $this->password = $password;
        return $this;
    }
}
