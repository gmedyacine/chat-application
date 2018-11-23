<?php

namespace src\Security;

/**
 * Class Token
 * @package src\Security
 */
class Token
{
    /**
     * @return string
     */
    public static function generate()
    {
        return $_SESSION['token'] = md5($_SESSION['token'] ?? time() * rand(60, 122));
    }

    /**
     * @param $token
     * @return bool
     */
    public static function check($token): bool
    {
        if(isset($_SESSION['token']) && $token === $_SESSION['token']){
            unset($_SESSION['token']);
            return true;
        }
        return false;
    }
}
