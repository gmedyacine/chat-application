<?php

namespace src\Controller;

/**
 * Class HomeController
 * @package src\Controller
 */
class HomeController extends \app\AbstractController
{
    /**
     * @var string
     */
    protected $template = 'default';

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->viewPath = ROOT . '/public/';
    }
}
