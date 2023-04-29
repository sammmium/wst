<?php

namespace App;

use DI\Container;
use DI\ContainerBuilder;

$builder = new ContainerBuilder();
$builder->useAutowiring(false);
$builder->addDefinitions(require_once __DIR__ . '/dependencies.php');

return $builder->build();
