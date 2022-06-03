<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

defined('ROOT_ACCESS') or exit('Restricted Access');

return function (RoutingConfigurator $routes) {
    $routes->add('home', '/')
        ->controller([\App\Controllers\HomeController::class]);
};
