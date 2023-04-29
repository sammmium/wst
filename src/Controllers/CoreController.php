<?php

namespace App\Controllers;

use App\App;

class CoreController
{
    protected $app;

    protected $view;

    protected $menu;

    protected $footer;

    public function __construct($app)
    {
        $this->app = $app;
        $this->view = $this->app->get('View');
        $this->menu = $this->app->get('Menu');
        $this->footer = $this->app->get('Footer');

        // dd($this->footer->getFooter());
    }
}
