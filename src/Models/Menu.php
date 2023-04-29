<?php

namespace App\Models;

class Menu
{
    private $menu;

    public function __construct(array $menu)
    {
        $this->menu = $menu;
    }

    public function getMenu(): array
	{
		$menu = [];

		foreach ($this->menu as $item) {
			if ($item['enabled']) {
				$menu[] = $item;
			}
		}

		return $menu;
	}
}
