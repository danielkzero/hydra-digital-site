<?php

declare(strict_types=1);

namespace App\Domain\Post;

interface PostRepository
{
    public function findAll(bool $publishedOnly = false, ?int $limit = null): array;

    public function findBySlug(string $slug, bool $publishedOnly = false): array;

    public function findById(int $id): array;

    public function create(array $data): array;

    public function update(int $id, array $data): array;

    public function delete(int $id): void;
}
