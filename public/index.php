<?php

namespace App;

use App\App;

require dirname(__DIR__) . '/vendor/autoload.php';

$app = new App();
echo $app->run();
