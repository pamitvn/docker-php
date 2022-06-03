<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Response;

defined('ROOT_ACCESS') or exit('Restricted Access');

class HomeController
{
    public function __invoke(): Response
    {
        return new Response(file_get_contents(ROOT_PATH . '/views/index.html'));
    }
}
