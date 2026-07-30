<?php

declare(strict_types=1);

namespace App\Application\Actions\Post;

use App\Application\Actions\Action;
use App\Domain\Post\PostRepository;
use Psr\Log\LoggerInterface;
use Slim\Exception\HttpBadRequestException;

abstract class PostAction extends Action
{
    protected PostRepository $postRepository;

    public function __construct(LoggerInterface $logger, PostRepository $postRepository)
    {
        parent::__construct($logger);
        $this->postRepository = $postRepository;
    }

    protected function getValidatedPayload(bool $partial = false): array
    {
        $data = $this->getFormData();
        if (!is_array($data)) {
            throw new HttpBadRequestException($this->request, 'Invalid payload.');
        }

        $title = isset($data['title']) ? trim((string) $data['title']) : '';
        $excerpt = isset($data['excerpt']) ? trim((string) $data['excerpt']) : '';
        $content = isset($data['content']) ? trim((string) $data['content']) : '';

        if (!$partial || array_key_exists('title', $data)) {
            if ($title === '') {
                throw new HttpBadRequestException($this->request, 'Field `title` is required.');
            }
        }

        if (!$partial || array_key_exists('excerpt', $data)) {
            if ($excerpt === '') {
                throw new HttpBadRequestException($this->request, 'Field `excerpt` is required.');
            }
        }

        if (!$partial || array_key_exists('content', $data)) {
            if ($content === '') {
                throw new HttpBadRequestException($this->request, 'Field `content` is required.');
            }
        }

        return [
            'title' => $title,
            'slug' => isset($data['slug']) ? trim((string) $data['slug']) : null,
            'excerpt' => $excerpt,
            'content' => $content,
            'cover_image' => isset($data['coverImage']) ? trim((string) $data['coverImage']) : null,
            'published' => isset($data['published']) ? (bool) $data['published'] : null,
        ];
    }
}
