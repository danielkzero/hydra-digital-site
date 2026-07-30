<?php

declare(strict_types=1);

namespace App\Application\Actions\Auth;

use App\Application\Actions\Action;
use App\Domain\Admin\AdminRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use Slim\Exception\HttpBadRequestException;

class UpdateAccountAction extends Action
{
    private AdminRepository $adminRepository;

    public function __construct(LoggerInterface $logger, AdminRepository $adminRepository)
    {
        parent::__construct($logger);
        $this->adminRepository = $adminRepository;
    }

    protected function action(): Response
    {
        $admin = $this->request->getAttribute('admin');
        $data = $this->getFormData();

        if (!is_array($data)) {
            throw new HttpBadRequestException($this->request, 'Payload inválido.');
        }

        $email = trim((string) ($data['email'] ?? ''));
        $currentPassword = (string) ($data['currentPassword'] ?? '');
        $password = (string) ($data['password'] ?? '');
        $passwordConfirmation = (string) ($data['passwordConfirmation'] ?? '');

        if ($email === '') {
            throw new HttpBadRequestException($this->request, 'E-mail é obrigatório.');
        }

        $this->adminRepository->verifyCredentials($admin['email'], $currentPassword);

        if ($password !== '' && $password !== $passwordConfirmation) {
            throw new HttpBadRequestException($this->request, 'A confirmação de senha não confere.');
        }

        $updated = $this->adminRepository->updateCredentials(
            (int) $admin['id'],
            $email,
            $password !== '' ? $password : null
        );

        return $this->respondWithData($updated);
    }
}
