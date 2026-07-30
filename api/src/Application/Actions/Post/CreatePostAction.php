<?php

declare(strict_types=1);

namespace App\Application\Actions\Post;

use Psr\Http\Message\ResponseInterface as Response;

class CreatePostAction extends PostAction
{
    protected function action(): Response
    {
        $post = $this->postRepository->create($this->getValidatedPayload());

        return $this->respondWithData($post, 201);
    }
}
