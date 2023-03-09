<?php

use App\Kernel;

const ROOT_PATH = __DIR__;
const ROOT_PACKAGE_PATH = ROOT_PATH . '/packages';
const ROOT_ACCESS = true;

require_once __DIR__ . '/vendor/autoload_runtime.php';

return function (array $context) {
    \App\Services\Config::load();
    return new Kernel($context['APP_ENV'], (bool)$context['APP_DEBUG']);
};
