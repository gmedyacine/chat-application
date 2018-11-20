<?php
define('ROOT', dirname(__DIR__));
define("APPPATH", ROOT . '/src');

require APPPATH . '/App.php';

src\App::load();

// router en fonction les paramètres de l'url
if (isset($_GET['p'])) {
    $page = $_GET['p'];
} else {
    $page = 'default.login';
}

$page = explode('.', $page);
$controller = '\src\controller\\' . ucfirst($page[0]) . 'Controller';
$action = $page[1];
$controller = new $controller();
$controller->$action();
