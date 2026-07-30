<?php

declare(strict_types=1);

namespace App\Application\Actions\Auth;

use App\Application\Actions\Action;
use App\Application\Security\TokenService;
use App\Domain\Admin\AdminRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use Slim\Exception\HttpBadRequestException;

class LoginAction extends Action
{
    private AdminRepository $adminRepository;

    private TokenService $tokenService;

    public function __construct(
        LoggerInterface $logger,
        AdminRepository $adminRepository,
        TokenService $tokenService
    ) {
        parent::__construct($logger);
        $this->adminRepository = $adminRepository;
        $this->tokenService = $tokenService;
    }

    protected function action(): Response
    {
        $data = $this->getFormData();
        if (!is_array($data)) {
            throw new HttpBadRequestException($this->request, 'Payload inválido.');
        }

        $email = trim((string) ($data['email'] ?? ''));
        $password = (string) ($data['password'] ?? '');
        if ($email === '' || $password === '') {
            throw new HttpBadRequestException($this->request, 'E-mail e senha são obrigatórios.');
        }

        $admin = $this->adminRepository->verifyCredentials($email, $password);

        return $this->respondWithData([
            'token' => $this->tokenService->generate($admin),
            'admin' => $admin,
        ]);
    }
}
