<?php

namespace App;

use App\Controllers\CoreController;
use App\Models\Config;
use App\Models\Footer;
use App\Models\Menu;
use Psr\Container\ContainerInterface;
use Twig\Loader\FilesystemLoader as Loader;
use Twig\Environment as Twig;
use Twig\TwigFunction;

define('VIEWS_DIRECTORY', __DIR__ . '/../../src/Views');
define('PUBLIC_DIRECTORY', __DIR__ . '/../../public');
define('CSS_DIRECTORY', '../../css/%s');
define('FONAWESOME_DIRECTORY', '../../fontawesome-free-5.15.4-web/css/%s');
define('JS_DIRECTORY', '../../js/%s');

$loader = new Loader(VIEWS_DIRECTORY);
$loader->addPath(PUBLIC_DIRECTORY, 'public');
$view = new Twig($loader);
$view->addFunction(new TwigFunction('asset_css', function ($asset_css) {
    return sprintf(CSS_DIRECTORY, $asset_css);
}));
$view->addFunction(new TwigFunction('asset_fa', function ($asset_fa) {
    return sprintf(FONAWESOME_DIRECTORY, $asset_fa);
}));
$view->addFunction(new TwigFunction('asset_js', function ($asset_js) {
    return sprintf(JS_DIRECTORY, $asset_js);
}));

return [

    'View' => $view,

    'Menu' => function(ContainerInterface $ci) {
        return new Menu($ci->get('menu'));
    },

    'Footer' => function(ContainerInterface $ci) {
        return new Footer($ci->get('footer'));
    },

];
