<?php

namespace App\Traits;

trait SingletonTrait
{
	private static $instance = null;

	public static function getInstance()
	{
		return (static::$instance) ?? (static::$instance = new static());
	}

	private function __construct()
	{

	}

	private function __clone()
	{

	}

	private function __wakeup()
	{

	}

	public static function getClassName()
	{
		return self::class;
	}
}