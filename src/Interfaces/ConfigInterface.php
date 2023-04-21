<?php

namespace App\Interfaces;

interface ConfigInterface
{
    public function getConfig(string $key): string;
}
