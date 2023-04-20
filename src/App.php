<?php

namespace App;

use App\Interfaces\AppInterface;
use App\Models\Config;
use App\Models\Router;
use Twig\Loader\FilesystemLoader as Loader;
use Twig\Environment as Twig;

require_once __DIR__ . '/interfaces/AppInterface.php';
require_once __DIR__ . '/models/Config.php';
require_once __DIR__ . '/models/Router.php';
require_once dirname(__DIR__) . '/vendor/twig/twig/src/Loader/FilesystemLoader.php';
require_once dirname(__DIR__) . '/vendor/twig/twig/src/Environment.php';

class App implements AppInterface
{
    private $config = [];

    private $menu = [];

    public function __construct()
    {
        $this->gatherConfig();
        $this->gatherMenu();
    }

    private function gatherConfig(): void
    {
        $config = new Config();
        $this->config = $config->getConfigs();
    }

	public function gatherMenu(): void
	{
		foreach ($this->config['menu'] as $section) {
			if ($section['enabled']) {
				$this->menu[] = $section;
			}
		}
	}

    public function run()
    {
        $loader = new Loader(__DIR__ . '/views');
		$loader->addPath(dirname(__DIR__) . '/public', 'public');
		$view = new Twig($loader);

		$routes = require_once __DIR__ . '/routes.php';
		$router = new Router();
        $router->setPath($_SERVER['REQUEST_URI']);
        $router->setRoutes($routes);
        $router->setConfig($this->config);
        $router->setView($view);
        $router->setMenu($this->menu);

		return $router->init();
    }
}
