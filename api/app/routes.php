<?php

declare(strict_types=1);

use App\Application\Actions\Auth\LoginAction;
use App\Application\Actions\Auth\MeAction;
use App\Application\Actions\Auth\UpdateAccountAction;
use App\Application\Actions\Post\CreatePostAction;
use App\Application\Actions\Post\DeletePostAction;
use App\Application\Actions\Post\ListAdminPostsAction;
use App\Application\Actions\Post\ListPostsAction;
use App\Application\Actions\Post\UpdatePostAction;
use App\Application\Actions\Post\ViewPostAction;
use App\Application\Actions\Upload\UploadImageAction;
use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use App\Application\Middleware\AuthMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hydra Digital API');
        return $response;
    });

    $app->get('/api/health', function (Request $request, Response $response) {
        $response->getBody()->write(json_encode([
            'status' => 'ok',
            'timestamp' => gmdate('c'),
        ], JSON_UNESCAPED_UNICODE));

        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/api/auth/login', LoginAction::class);

    $app->group('/api/posts', function (Group $group) {
        $group->get('', ListPostsAction::class);
        $group->get('/{slug}', ViewPostAction::class);
    });

    $app->group('/api/admin', function (Group $group) {
        $group->get('/auth/me', MeAction::class);
        $group->put('/auth/account', UpdateAccountAction::class);

        $group->get('/posts', ListAdminPostsAction::class);
        $group->post('/posts', CreatePostAction::class);
        $group->put('/posts/{id}', UpdatePostAction::class);
        $group->delete('/posts/{id}', DeletePostAction::class);

        $group->post('/uploads', UploadImageAction::class);
    })->add(AuthMiddleware::class);

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });
};
