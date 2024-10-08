<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Dotenv\Dotenv;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function boot(): void
    {
        parent::boot();

        // Solo carga el archivo .env en los entornos de desarrollo o testing
        if ($this->getEnvironment() === 'dev' || $this->getEnvironment() === 'test') {
            (new Dotenv())->bootEnv(dirname(__DIR__).'/.env');
        }
    }
}
