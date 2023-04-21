<?php

namespace App\Traits;

use App\Interfaces\MultytonInterface;

require_once __DIR__ . '/../interfaces/MultytonInterface.php';

trait MultytonTrait
{
    protected static $instances = [];

    // private $name;

    private function __construct()
    {
        
    }

    private function __clone()
    {
        
    }

    private function __wakeup()
    {
        
    }

    public static function getInstance(string $instanceName): MultytonInterface
    {
        if (isset(static::$instances[$instanceName])) {
            return static::$instances[$instanceName];
        }

        static::$instances[$instanceName] = new static();
        // static::$instances[$instanceName]->setInstance($instanceName);

        return static::$instances[$instanceName];
    }

    // public function setName(string $name)
    // {
    //     $this->name = $name;

    //     return $this;
    // }

    // private function setInstance(string $name)
    // {
    //     $instanceName = 'App\\Models\\' . ucfirst($name);
    //     static::$instances[$name] = new $instanceName();
    // }
}
