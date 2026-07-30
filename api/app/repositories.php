<?php

declare(strict_types=1);

use App\Domain\Admin\AdminRepository;
use App\Domain\Post\PostRepository;
use App\Domain\User\UserRepository;
use App\Infrastructure\Persistence\Admin\SqliteAdminRepository;
use App\Infrastructure\Persistence\Post\SqlitePostRepository;
use App\Infrastructure\Persistence\User\InMemoryUserRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        UserRepository::class => \DI\autowire(InMemoryUserRepository::class),
        PostRepository::class => \DI\autowire(SqlitePostRepository::class),
        AdminRepository::class => \DI\autowire(SqliteAdminRepository::class),
    ]);
};
