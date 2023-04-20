<?php

namespace App\controllers;

class CoreController
{
    protected $view;

    protected $menu;

    public function setView($view): void
    {
        $this->view = $view;
    }
    
    public function setMenu($menu): void
    {
        $this->menu = $menu;
    }
}
