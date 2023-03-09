<?php

use Illuminate\Support\Str;

defined('ROOT_ACCESS') or exit('Restricted Access');

if (!function_exists('view_path')) {
    function view_path(?string $path = null): string
    {
        $viewPath = ROOT_PACKAGE_PATH . '/views';

        if (Str::startsWith($path, '/')) {
            $path = Str::replaceFirst('/', '', $path);
        }

        return "$viewPath/{$path}";
    }
}

if (!function_exists('getDirectoryOfFile')) {
    function getDirectoryOfFile($filePath): string
    {
        $directory = explode('/', $filePath);
        unset($directory[count($directory) - 1]);

        return implode('/', $directory);
    }
}


