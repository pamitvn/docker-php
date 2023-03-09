<?php

use Symfony\Component\Filesystem\Filesystem;

defined('ROOT_ACCESS') or exit('Restricted Access');

if (!function_exists('write_log_to_file')) {
    function write_log_to_file(string $filePath, string $content): void
    {
        $filesystem = new Filesystem();


        if (!$filesystem->exists($filePath)) {
            $filesystem->mkdir(getDirectoryOfFile($filePath), 777);
            $filesystem->touch($filePath);
        }

        $currentContent = @file_get_contents($filePath);

        if (false === $currentContent) {
            $currentContent = '';
        }

        $currentContent .= $content . "\n";

        $filesystem->dumpFile($filePath, $currentContent);
    }
}

if (!function_exists('write_log_to_telegram')) {
    function write_log_to_telegram(string $message): void
    {
        try {
            $token = config('pam.3rd.telegram.token');
            $id = config('pam.3rd.telegram.id');

            $client = new \GuzzleHttp\Client(['http_errors' => false]);
            $client->getAsync("https://api.telegram.org/bot{$token}/sendMessage", [
                'query' => [
                    'chat_id' => $id,
                    'text' => $message
                ],
            ]);
        } catch (Exception|Throwable|\GuzzleHttp\Exception\GuzzleException) {
        }
    }
}

