<?php

use Composer\Autoload\ClassLoader;

const ROOT_PATH = __DIR__;
const ROOT_ACCESS = 1;

/** @var ClassLoader $loader */
$loader = require ROOT_PATH . '/vendor/autoload.php';

$core = new \App\Platform\Core($loader);

$core->handle();
