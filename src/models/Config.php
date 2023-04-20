<?php

namespace App\Models;

use App\Interfaces\ConfigInterface;

require_once __DIR__ . '/../interfaces/ConfigInterface.php';

class Config implements ConfigInterface
{
    const SEPARATOR = '.';

    private $configs;

    public function __construct()
    {
        $files = scandir(__DIR__ . '/../configurations');

        foreach ($files as $file) {
            if (preg_match('/\.(php)/', $file)) {
                $valueFile = require __DIR__ . '/../configurations/' . $file;
                if (is_array($valueFile)) {
                    $this->setConfig($valueFile);
                }
            }
        }
    }

    private function setConfig(array $config): void
    {
        foreach ($config as $key => $item) {
            if (empty($this->configs[$key])) {
                $this->configs[$key] = $item;
            }
        }
    }

    public function getConfig(string $key): string
    {
        if ($this->hasLevels($key)) {
            $keys = explode(self::SEPARATOR, $key);
            return $this->extract($this->configs, $keys);
        }

        return is_string($this->configs[$key]) ? $this->configs[$key] : '';
    }

    public function getConfigs()
    {
        return $this->configs;
    }

    private function hasLevels(string $key): bool
    {
        return strpos($key, self::SEPARATOR);
    }

    private function extract(array $configs, array $keys)
    {
        if (count($keys) > 1) {
            $firstKey = $keys[0];
            unset($keys[0]);
            $keys = array_values($keys);
            $extracted = $configs[$firstKey];
            return $this->extract($extracted, $keys);
        }
        
        $keys = array_values($keys);
        $firstKey = $keys[0];
        return $configs[$firstKey];
    }
}
