<?php

namespace src;

use app\Config;
use app\Database\MysqlDatabase;

/*
 * Class principale qui permet de charger une instance de l'autoloader et de la connexion à la base de donnée
 */

/**
 * Class Home
 * @package src
 */
class Home
{
    /**
     * @var $instance une instance de l'autolaoder
     */
    private static $instance;
    /**
     * @var $dbInstance une instance de la bd
     */
    private $dbInstance;

    /**
     * @return Home
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new Home();
        }
        return self::$instance;
    }

    /**
     *
     */
    public static function load()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        // chargement des autoloaders
        require APPPATH . '/Autoloader.php';
        Autoloader::register();
        require ROOT . '/app/Autoloader.php';
        \app\Autoloader::register();
    }

    /**
     * @return MysqlDatabase
     */
    public function getDb()
    {
        // récupération des paramètres de connexion
        $config = Config::getInstance(ROOT . '/config/config.php');

        // instanciation de la BDD si elle n'existe pas
        if (is_null($this->dbInstance)) {
            $this->dbInstance = new MysqlDatabase($config->get('database'),
                $config->get('user'),
                $config->get('password'),
                $config->get('host')
            );
        }
        return $this->dbInstance;
    }
}
