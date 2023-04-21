<?php

namespace App\Models;

use App\Traits\MultytonTrait;
use App\Interfaces\MultytonInterface;
use App\Models\Config;

require_once __DIR__ . '/../interfaces/MultytonInterface.php';
require_once __DIR__ . '/../traits/MultytonTrait.php';
// require_once __DIR__ . '/Config.php';

class MultytonApp implements MultytonInterface
{
    use MultytonTrait;

    // private $item;

    // public function setItem(string $name)
    // {
    //     $this->item = new $name();

    //     return $this;
    // }
}
