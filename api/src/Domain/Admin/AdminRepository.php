<?php

declare(strict_types=1);

namespace App\Domain\Admin;

interface AdminRepository
{
    public function findById(int $id): array;

    public function findByEmail(string $email): array;

    public function verifyCredentials(string $email, string $password): array;

    public function updateCredentials(int $id, string $email, ?string $password): array;
}
