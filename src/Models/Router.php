<?php

namespace App\Models;

class Router
{
	protected string $path;

	protected array $routes;

	protected array $config;

    protected $view;

    protected array $menu;

	protected array $route = [
		'path' => '/',
		'controller' => 'HomeController',
		'action' => 'index',
        'method' => 'GET',
		'view' => 'home/index.twig',
		'selected_menu_item' => 'home'
	];

    public function setPath(string $request_url): void
    {
        $this->path = $request_url;
    }

    public function setRoutes(array $routes): void
    {
        $this->routes = $routes;
    }

    public function setConfig(array $config): void
    {
        $this->config = $config;
    }

    public function setView($view): void
    {
        $this->view = $view;
    }

    public function setMenu(array $menu): void
    {
        $this->menu = $menu;
    }

	public function init(): string
	{
		$id = 0;
		foreach ($this->routes as $path => $data) {
			$clearPath = '';
			$pos = strpos($path, '{id}');
			if ($pos !== false) {
				$id = mb_substr($this->path, $pos);
				$clearPath = mb_substr($this->path, 0, $pos);
				if ($clearPath === mb_substr($path, 0, $pos)) {
					$this->route = [];
					$this->route['path'] = $clearPath;
					$this->route += $data;
					break;
				}
			} else {
				if ($this->path === $path) {
					$this->route = [];
					$this->route['path'] = $path;
					$this->route += $data;
					break;
				}
			}
		}
        
        if ($this->isBadRequestMethod()) {
            $pathController = 'App\\Controllers\\HomeController';
        } else {
            $pathController = 'App\\Controllers\\' . $this->route['controller'];
        }

		$controller = new $pathController();
        $controller->setView($this->view);
        $controller->setMenu($this->menu);
		$method = $this->route['action'];

		return ($id > 0) ? $controller->$method($id) : $controller->$method();
	}

    private function isBadRequestMethod()
    {
        return $_SERVER['REQUEST_METHOD'] !== $this->route['method'];
    }
}
