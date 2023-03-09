<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

defined('ROOT_ACCESS') or exit('Restricted Access');

class Config
{
    protected static string $configPath = ROOT_PACKAGE_PATH . '/config';
    protected static array $config = [];

    static function load()
    {
        $scan = glob(self::$configPath . "/{,*/,*/*/,*/*/*/}*.php", GLOB_BRACE);

        foreach ($scan as $path) {
            $key = Str::replace([
                self::$configPath . '/',
                '.php'
            ], '', $path);

            if (!file_exists($path)) continue;

            $config = include $path;

            if (is_callable($config)) continue;

            self::set($key, $config);

        }
    }

    static function all(): array
    {
        return self::$config;
    }

    static function get(string $key, $default = null)
    {
        return Arr::get(self::$config, $key, $default);
    }

    static function set($key, $value = null)
    {
        if (!is_array($key)) {
            $key = [$key => $value];
        }

        foreach (Arr::dot($key) as $path => $value) {
            Arr::set(self::$config, $path, $value);
        }
    }
}
