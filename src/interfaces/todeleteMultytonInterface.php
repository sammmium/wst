<?php

namespace App\Interfaces;

interface MultytonInterface
{
    public static function getInstance(string $instanceName): self;
}
