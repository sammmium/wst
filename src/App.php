<?php

namespace App;

use App\Interfaces\AppInterface;
use App\Models\Config;
use App\Models\Router;
use Twig\Loader\FilesystemLoader as Loader;
use Twig\Environment as Twig;
use Twig\TwigFunction;

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
        $loader = new Loader(__DIR__ . '/Views');
		$loader->addPath(dirname(__DIR__) . '/public', 'public');
		$view = new Twig($loader);
        $view->addFunction(new TwigFunction('asset_css', function ($asset_css) {
            return sprintf('../css/%s', $asset_css);
        }));
        $view->addFunction(new TwigFunction('asset_fa', function ($asset_fa) {
            return sprintf('../fontawesome-free-5.15.4-web/css/%s', $asset_fa);
        }));
        $view->addFunction(new TwigFunction('asset_js', function ($asset_js) {
            return sprintf('../js/%s', $asset_js);
        }));

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
