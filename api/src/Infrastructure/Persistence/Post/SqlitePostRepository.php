<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Post;

use App\Domain\Post\PostNotFoundException;
use App\Domain\Post\PostRepository;
use PDO;

class SqlitePostRepository implements PostRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
        $this->initializeDatabase();
    }

    public function findAll(bool $publishedOnly = false, ?int $limit = null): array
    {
        $sql = 'SELECT * FROM posts';
        if ($publishedOnly) {
            $sql .= ' WHERE published = 1';
        }

        $sql .= ' ORDER BY created_at DESC';
        if ($limit !== null) {
            $sql .= ' LIMIT :limit';
        }

        $statement = $this->connection->prepare($sql);
        if ($limit !== null) {
            $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        }

        $statement->execute();

        return array_map([$this, 'mapPost'], $statement->fetchAll(PDO::FETCH_ASSOC) ?: []);
    }

    public function findBySlug(string $slug, bool $publishedOnly = false): array
    {
        $sql = 'SELECT * FROM posts WHERE slug = :slug';
        if ($publishedOnly) {
            $sql .= ' AND published = 1';
        }
        $sql .= ' LIMIT 1';

        $statement = $this->connection->prepare($sql);
        $statement->execute(['slug' => $slug]);

        $post = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$post) {
            throw new PostNotFoundException($slug);
        }

        return $this->mapPost($post);
    }

    public function findById(int $id): array
    {
        $statement = $this->connection->prepare('SELECT * FROM posts WHERE id = :id LIMIT 1');
        $statement->execute(['id' => $id]);

        $post = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$post) {
            throw new PostNotFoundException((string) $id);
        }

        return $this->mapPost($post);
    }

    public function create(array $data): array
    {
        $timestamp = gmdate('c');
        $slug = $this->buildUniqueSlug($data['slug'] ?? $data['title']);

        $statement = $this->connection->prepare(
            'INSERT INTO posts (title, slug, excerpt, content, cover_image, published, created_at, updated_at)
             VALUES (:title, :slug, :excerpt, :content, :cover_image, :published, :created_at, :updated_at)'
        );

        $statement->execute([
            'title' => trim($data['title']),
            'slug' => $slug,
            'excerpt' => trim($data['excerpt']),
            'content' => trim($data['content']),
            'cover_image' => $data['cover_image'] ?: null,
            'published' => !empty($data['published']) ? 1 : 0,
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
        ]);

        return $this->findById((int) $this->connection->lastInsertId());
    }

    public function update(int $id, array $data): array
    {
        $current = $this->findById($id);
        $title = trim($data['title'] ?? $current['title']);
        $slug = $data['slug'] ?? $title;
        $uniqueSlug = $this->buildUniqueSlug($slug, $id);

        $statement = $this->connection->prepare(
            'UPDATE posts
             SET title = :title,
                 slug = :slug,
                 excerpt = :excerpt,
                 content = :content,
                 cover_image = :cover_image,
                 published = :published,
                 updated_at = :updated_at
             WHERE id = :id'
        );

        $statement->execute([
            'id' => $id,
            'title' => $title,
            'slug' => $uniqueSlug,
            'excerpt' => trim($data['excerpt'] ?? $current['excerpt']),
            'content' => trim($data['content'] ?? $current['content']),
            'cover_image' => $data['cover_image'] ?? $current['coverImage'],
            'published' => array_key_exists('published', $data) ? (!empty($data['published']) ? 1 : 0) : ($current['published'] ? 1 : 0),
            'updated_at' => gmdate('c'),
        ]);

        return $this->findById($id);
    }

    public function delete(int $id): void
    {
        $this->findById($id);

        $statement = $this->connection->prepare('DELETE FROM posts WHERE id = :id');
        $statement->execute(['id' => $id]);
    }

    private function initializeDatabase(): void
    {
        $this->connection->exec(
            'CREATE TABLE IF NOT EXISTS posts (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                title TEXT NOT NULL,
                slug TEXT NOT NULL UNIQUE,
                excerpt TEXT NOT NULL,
                content TEXT NOT NULL,
                cover_image TEXT NULL,
                published INTEGER NOT NULL DEFAULT 1,
                created_at TEXT NOT NULL,
                updated_at TEXT NOT NULL
            )'
        );

        $count = (int) $this->connection->query('SELECT COUNT(*) FROM posts')->fetchColumn();
        if ($count === 0) {
            $this->seedWelcomePost();
        }
    }

    private function seedWelcomePost(): void
    {
        $this->create([
            'title' => 'Bem-vindo ao blog da Hydra Digital',
            'excerpt' => 'Primeira publicação da área de conteúdo, pronta para evoluir junto com o site.',
            'content' => "Este blog agora pode ser gerenciado pela API em Slim com SQLite.\n\nVocê pode publicar novidades, estudos de caso, lançamentos de aplicativos e atualizações institucionais.",
            'cover_image' => null,
            'published' => true,
        ]);
    }

    private function buildUniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $baseSlug = $this->slugify($value);
        $slug = $baseSlug;
        $index = 1;

        while ($this->slugExists($slug, $ignoreId)) {
            $slug = "{$baseSlug}-{$index}";
            $index++;
        }

        return $slug;
    }

    private function slugExists(string $slug, ?int $ignoreId = null): bool
    {
        $sql = 'SELECT COUNT(*) FROM posts WHERE slug = :slug';
        $params = ['slug' => $slug];

        if ($ignoreId !== null) {
            $sql .= ' AND id != :id';
            $params['id'] = $ignoreId;
        }

        $statement = $this->connection->prepare($sql);
        $statement->execute($params);

        return (int) $statement->fetchColumn() > 0;
    }

    private function slugify(string $value): string
    {
        $slug = mb_strtolower(trim($value));
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $slug) ?: $slug;
        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug) ?: '';
        $slug = trim($slug, '-');

        return $slug !== '' ? $slug : 'post';
    }

    private function mapPost(array $post): array
    {
        return [
            'id' => (int) $post['id'],
            'title' => $post['title'],
            'slug' => $post['slug'],
            'excerpt' => $post['excerpt'],
            'content' => $post['content'],
            'coverImage' => $post['cover_image'],
            'published' => (bool) $post['published'],
            'createdAt' => $post['created_at'],
            'updatedAt' => $post['updated_at'],
        ];
    }
}
