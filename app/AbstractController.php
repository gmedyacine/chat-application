<?php

namespace app;


abstract class AbstractController
{
    /**
     * @param $view nom de la vue - exemple login
     * @param array $parameters
     */
    protected function render($view, $parameters = [])
    {
        ob_start();
        extract($parameters);
        require($this->viewPath . str_replace('.', '/', $view) . '.php');
        //$content = ob_get_clean();
        require($this->viewPath . 'templates/' . $this->template . '.php');
    }
}
