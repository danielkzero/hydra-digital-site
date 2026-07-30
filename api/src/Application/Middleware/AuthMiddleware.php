<?php

declare(strict_types=1);

namespace App\Application\Middleware;

use App\Application\Security\TokenService;
use App\Domain\Admin\AdminRepository;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthMiddleware implements MiddlewareInterface
{
    private ResponseFactoryInterface $responseFactory;

    private TokenService $tokenService;

    private AdminRepository $adminRepository;

    public function __construct(
        ResponseFactoryInterface $responseFactory,
        TokenService $tokenService,
        AdminRepository $adminRepository
    ) {
        $this->responseFactory = $responseFactory;
        $this->tokenService = $tokenService;
        $this->adminRepository = $adminRepository;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $header = $request->getHeaderLine('Authorization');
        if (!preg_match('/Bearer\s+(.*)$/i', $header, $matches)) {
            return $this->unauthorized();
        }

        $payload = $this->tokenService->validate($matches[1]);
        if ($payload === null) {
            return $this->unauthorized();
        }

        $admin = $this->adminRepository->findById((int) $payload['sub']);
        return $handler->handle($request->withAttribute('admin', $admin));
    }

    private function unauthorized(): ResponseInterface
    {
        $response = $this->responseFactory->createResponse(401);
        $response->getBody()->write(json_encode([
            'statusCode' => 401,
            'error' => [
                'type' => 'UNAUTHORIZED',
                'description' => 'Token inválido ou ausente.',
            ],
        ], JSON_UNESCAPED_UNICODE));

        return $response->withHeader('Content-Type', 'application/json');
    }
}
