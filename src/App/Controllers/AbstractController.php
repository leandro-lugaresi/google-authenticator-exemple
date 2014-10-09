<?php

namespace App\Controllers;

abstract class AbstractController
{
    protected $view;
    protected $action;

    public function __construct()
    {
        $this->view = new \Stdclass();
    }

    protected function render($view)
    {
        $this->action = $view;
        if(file_exists('src/App/views/layout.phtml'))
            include_once 'src/App/views/layout.phtml';
        else
            $this->content($view);
    }

    protected function content()
    {
        $x = get_class($this);
        $singleClassName = strtolower(str_replace("App\\Controllers\\","",$x));
        include_once 'src/App/views/'.$singleClassName.'/'.$this->action.'.phtml';
    }

}
