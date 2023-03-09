<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function getCacheDir(): string
    {
        return sprintf('%s/var/%s/cache', ROOT_PACKAGE_PATH, $this->environment);
    }

    public function getLogDir(): string
    {
        return sprintf('%s/var/%s/log', ROOT_PACKAGE_PATH, $this->environment);
    }
}
