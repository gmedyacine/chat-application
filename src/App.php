<?php

namespace src;

use app\Config;
use app\Database\MysqlDatabase;

/*
 * Class principale qui permet de charger une instance de l'autoloader et de la connexion à la base de donnée
 */
class App
{
    private static $_instance;
    private $_dbInstance;

    public static function getInstance(){
        if(is_null(self::$_instance)){
            self::$_instance = new App();
        }
        return self::$_instance;
    }

    public static function load()
    {
        if(!isset($_SESSION)) {
            session_start();
        }
        // chargement des autoloaders
        require APPPATH .'/Autoloader.php';
        Autoloader::register();
        require ROOT . '/app/Autoloader.php';
        \app\Autoloader::register();
    }

    public function getDb()
    {
        // récupération des paramètres de connexion
        $config = Config::getInstance(ROOT . '/config/config.php');

        // instanciation de la BDD si elle n'existe pas
        if(is_null($this->_dbInstance)) {
            $this->_dbInstance = new MysqlDatabase($config->get('db_name'), $config->get('db_user'), $config->get('db_pass'), $config->get('db_host'));
        }
        return $this->_dbInstance;
    }
}
