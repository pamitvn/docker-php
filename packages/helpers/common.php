<?php

//use App\Controllers\AdminController;
use App\Services\Config;
use Illuminate\Support\Str;

defined('ROOT_ACCESS') or exit('Restricted Access');

if (!function_exists('onlyRootAccess')) {
    function onlyRootAccess()
    {
        return defined('ROOT_ACCESS') or exit('Restricted Access');
    }
}

if (!function_exists('config')) {
    function config($key = null, $default = null)
    {
        if (is_string($key)) {
            return Config::get($key, $default);
        }

        if (is_array($key)) {
            return Config::set($key);
        }

        return Config::all();
    }
}

if (!function_exists('template_string')) {
    function template_string(string $template, array $data = []): string
    {
        ob_start();
        if (!count($data)) return $template;

        $finders = [];
        $replacers = [];

        foreach ($data as $key => $value) {
            $finders[$key] = ":{$key}";
            $replacers[$key] = $value;
        }

        $result = Str::replace($finders, $replacers, $template);

        ob_clean();

        return $result;
    }
}

if (!function_exists('is_json')) {
    function is_json($value): bool
    {
        return is_object(@json_decode($value) ?? null);
    }
}

if (!function_exists('get_bank_results')) {
    function get_bank_results($bank, $list = []): array
    {
        return [
            'ResponseCode' => 1,
            'Orders' => [
                'Message' => rand(100000, 999999),
                'WalletAccountName' => $bank['account_name'],
                'WalletAccount' => $bank['account_no'],
                'Rate' => 1.0,
                'List' => empty($list) ? [
                    [
                        'Amount' => 10000,
                        'AmountReceive' => 10000,
                    ],
                    [
                        'Amount' => 20000,
                        'AmountReceive' => 20000,
                    ],
                    [
                        'Amount' => 100000,
                        'AmountReceive' => 100000,
                    ],
                    [
                        'Amount' => 200000,
                        'AmountReceive' => 200000,
                    ],
                    [
                        'Amount' => 500000,
                        'AmountReceive' => 500000,
                    ],
                    [
                        'Amount' => 1000000,
                        'AmountReceive' => 1000000,
                    ],
                ] : $list,
                'bank_provider' => data_get($bank, 'bank_code', 'momo'),
                'Min' => 20000,
                'Max' => 100000000,
            ],
        ];
    }
}

//if (!function_exists('get_settings')) {
//    function get_settings($key = null, $default = null)
//    {
//        $path = AdminController::STORE_SETTING_PATH;
//        $contents = collect(@json_decode(@file_get_contents($path), true));
//
//        return $key ? data_get($contents->toArray(), $key, $default) : $contents->toArray();
//    }
//}

//if (!function_exists('is_user_blocked')) {
//    function is_user_blocked($user): bool
//    {
//        $blockList = collect(get_settings('blocks', []));
//
//        return filled($blockList->first(fn($val) => strtolower(trim($val)) === strtolower(trim($user))));
//    }
//}