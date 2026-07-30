<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Admin;

use App\Domain\Admin\AdminNotFoundException;
use App\Domain\Admin\AdminRepository;
use PDO;

class SqliteAdminRepository implements AdminRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
        $this->initializeTable();
    }

    public function findById(int $id): array
    {
        $statement = $this->connection->prepare('SELECT id, email, created_at, updated_at FROM admins WHERE id = :id LIMIT 1');
        $statement->execute(['id' => $id]);

        $admin = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$admin) {
          throw new AdminNotFoundException((string) $id);
        }

        return $this->mapAdmin($admin);
    }

    public function findByEmail(string $email): array
    {
        $statement = $this->connection->prepare('SELECT id, email, password_hash, created_at, updated_at FROM admins WHERE email = :email LIMIT 1');
        $statement->execute(['email' => mb_strtolower(trim($email))]);

        $admin = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$admin) {
            throw new AdminNotFoundException($email);
        }

        return $admin;
    }

    public function verifyCredentials(string $email, string $password): array
    {
        $admin = $this->findByEmail($email);
        if (!password_verify($password, $admin['password_hash'])) {
            throw new AdminNotFoundException($email);
        }

        return $this->mapAdmin($admin);
    }

    public function updateCredentials(int $id, string $email, ?string $password): array
    {
        $current = $this->findById($id);
        $normalizedEmail = mb_strtolower(trim($email));

        $statement = $this->connection->prepare(
            'UPDATE admins
             SET email = :email,
                 password_hash = COALESCE(:password_hash, password_hash),
                 updated_at = :updated_at
             WHERE id = :id'
        );

        $statement->execute([
            'id' => $id,
            'email' => $normalizedEmail,
            'password_hash' => $password ? password_hash($password, PASSWORD_DEFAULT) : null,
            'updated_at' => gmdate('c'),
        ]);

        return $this->findById($id);
    }

    private function initializeTable(): void
    {
        $this->connection->exec(
            'CREATE TABLE IF NOT EXISTS admins (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                email TEXT NOT NULL UNIQUE,
                password_hash TEXT NOT NULL,
                created_at TEXT NOT NULL,
                updated_at TEXT NOT NULL
            )'
        );

        $count = (int) $this->connection->query('SELECT COUNT(*) FROM admins')->fetchColumn();
        if ($count === 0) {
            $this->seedDefaultAdmin();
        }
    }

    private function seedDefaultAdmin(): void
    {
        $timestamp = gmdate('c');
        $statement = $this->connection->prepare(
            'INSERT INTO admins (email, password_hash, created_at, updated_at)
             VALUES (:email, :password_hash, :created_at, :updated_at)'
        );

        $statement->execute([
            'email' => 'danikzero@hotmail.com',
            'password_hash' => password_hash('Vlp##2025sos', PASSWORD_DEFAULT),
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
        ]);
    }

    private function mapAdmin(array $admin): array
    {
        return [
            'id' => (int) $admin['id'],
            'email' => $admin['email'],
            'createdAt' => $admin['created_at'],
            'updatedAt' => $admin['updated_at'],
        ];
    }
}
