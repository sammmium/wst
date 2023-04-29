<?php

namespace App\Models;

class Config
{
    const SEPARATOR = '.';

    private $configs;

    public function setConfigs(array $configs)
    {
        $this->configs = $configs;
    }

    public function get(string $key): string
    {
        if ($this->hasLevels($key)) {
            $keys = explode(self::SEPARATOR, $key);
            return $this->extract($this->configs, $keys);
        }

        return is_string($this->configs[$key]) ? $this->configs[$key] : '';
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
