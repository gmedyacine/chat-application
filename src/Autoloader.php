<?php

namespace src;

class AutoLoader
{
    /**
     * @author Walid Mahmoud
     */
    static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoLoad'));
    }

    /**
     * @param $class - la classe à autloader
     * @author Walid Mahmoud
     */
    static function autoLoad($class)
    {
        // Pour la gestion de ce namespace
        if (strpos($class, __NAMESPACE__ . '\\') === 0) {
            $class = str_replace(__NAMESPACE__ . '\\', '', $class);
            // Au cas où nous sommes sous linux
            $class = str_replace('\\', '/', $class);
            require __DIR__ . '/' . $class . '.php';
        }
    }
}
