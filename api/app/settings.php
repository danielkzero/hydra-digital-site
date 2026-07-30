<?php

declare(strict_types=1);

use App\Application\Settings\Settings;
use App\Application\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Monolog\Logger;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        SettingsInterface::class => function () {
            return new Settings([
                'displayErrorDetails' => true,
                'logError' => false,
                'logErrorDetails' => false,
                'logger' => [
                    'name' => 'slim-app',
                    'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
                    'level' => Logger::DEBUG,
                ],
                'database' => [
                    'path' => __DIR__ . '/../var/data/blog.sqlite',
                ],
                'auth' => [
                    'secret' => 'hydra-digital-admin-secret-2026',
                    'ttl' => 60 * 60 * 8,
                ],
                'uploads' => [
                    'path' => __DIR__ . '/../public/uploads',
                ],
            ]);
        }
    ]);
};
