<?php

namespace App;

require dirname(__DIR__) . '/vendor/autoload.php';
require_once __DIR__ . '/../src/App.php';

$app = new App();
echo $app->run();
