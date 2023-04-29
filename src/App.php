<?php

namespace App;

use App\Interfaces\AppInterface;
use App\Models\Router;

/**
 * Summary of App
 */
class App implements AppInterface
{
    protected $app;

    public function __construct()
    {
        $this->app = require '../bootstrap/container.php';
    }

    public function run()
    {
		$router = new Router($this->app);

		return $router->init();
    }
}
